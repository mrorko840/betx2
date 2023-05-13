@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('SL')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Username')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                 @forelse ($users as $item)
                                    <tr>
                                        <td data-label="@lang('SL')">{{ $users->firstItem() + $loop->index }}</td>
                                        <td data-label="@lang('Name')">{{__($item->name)}}</td>
                                        <td data-label="@lang('Email')">{{ 
                                        $item->email
                                        }}</td>
                                        <td data-label="@lang('Username')">
                                           {{ $item->username }}
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <button type="button" class="icon-btn cuModalBtn" data-resource="{{$item}}" data-modal_title="@lang('Update '.ucfirst($type))" title="@lang('Edit')"><i class="la la-pencil-alt"></i></button>
                                          
                                          <form style="display:inline-block" method="post" action="{{ route('admin.admins.delete', $item->id) }}">
                                              @csrf
                                           <button onclick="return confirm('Are you sure you want to delete?');" type="submit" class="icon-btn btn-danger" style="background:red! important" title="@lang('Delete')"><i class="la la-trash"></i></button>  
                                        </form>
                                        
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                               
                            </tbody>
                            
                            
                        </table>
                    </div>
                </div>
                @if($users->hasPages())
                    <div class="card-footer py-4">
                        {{ $users->links('admin.partials.paginate') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Add METHOD MODAL --}}
    <div id="cuModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Add '.ucfirst($type))</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.admins.store', $type)}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        
                        
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Username') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ old('username') }}" name="username" required>
                        </div>
                        
                    
                      <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Email') <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" value="{{ old('email') }}" name="email" required>
                        </div>
                        
                    
                       <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Password') <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        
                         <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Confirm Password') <span class="text-danger">*</span></label>
                            <input type="password" class="form-control"  name="password_confirmation" required>
                        </div>
                        
                        
                        
    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('breadcrumb-plugins')
    <div class="d-flex flex-wrap justify-content-end flex-gap-8">

            <button type="button" class="btn btn--primary cuModalBtn" data-modal_title="@lang('Add '.ucfirst($type))"><i class="las la-plus"></i>@lang('Add New')</button>

        <form action="" method="GET" class="form-inline float-sm-right bg--white">
            <div class="input-group has_append">
                <input type="text" name="search" class="form-control" placeholder="@lang('Name')" value="{{ request()->search }}">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="las la-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    @endpush
@endsection