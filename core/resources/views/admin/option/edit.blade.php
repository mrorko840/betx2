@extends('admin.layouts.app')

@section('panel')
  

    <div class="row">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
              
             
                <div class="card-body px-0">
                 
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('SL')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Ratio')</th>
                                    <th>@lang('Profit')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($options as $key=> $item)
                                    <tr>
                                        <td data-label="@lang('SL')">{{ $key+1 }}</td>

                                        <td data-label="@lang('Name')">
                                            {{__($item->name)}} 
                                        </td>

                                        <td data-label="@lang('Invest Rate')">
                                            {{$item->dividend}} : {{$item->divisor}}
                                        </td>
                                        
                                        <td data-label="@lang('Name')">
                                            {{__($item->profit)}}% 
                                        </td>


                                        <td data-label="@lang('Status')">
                                            @if ($item->status == 1)
                                                <span class="badge badge--success">@lang('Enabled')</span>
                                            @else
                                                <span class="badge badge--danger">@lang('Disabled')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                           
                                                <button type="button" class="icon-btn cuModalBtn" data-modal_title="@lang('Update Score')" data-resource="{{ $item}}" data-has_status="1"><i class="la la-pencil-alt"></i> @lang('Edit')</button>
                                            
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
               
               
               
            </div>
        </div>
    </div>

    {{-- Add METHOD MODAL --}}
    <div id="cuModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Add New Option')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.option.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="question_id" value="1">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Ratio') <span class="text-danger">*</span></label>

                            <div class="input-group">

                                <input type="number" step="0.01" class="form-control" name="dividend" required>

                                <span class="input-group-text font-weight-bold rounded-0">:</span>
                                
                                <input type="number" step="0.01" class="form-control" name="divisor" required>

                            </div>
                            
                        </div>
                        
                         <div class="form-group">
                             <label>Profit %</label>
                             <input class="form-control" name="profit" />
                             
                         </div>

                        <div class="status"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

  
@endsection


@push('script')
    <script>
        'use strict';

        (function ($) {

            $('.makeLoserBtn').on('click', function () {
                var modal = $('#makeLoserModal');
                modal.modal('show');
            });

            $('.makeAbandonedBtn').on('click', function () {
                var modal = $('#makeAbandonedModal');
                modal.modal('show');
            });

            $('.makewinBtn').on('click', function () {
                var modal = $('#makewinModal');
                var name = $(this).data('name');
                var id = $(this).data('id');

                modal.find('.win-name').text(name);
                modal.find('.option-id').val(id);
                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush

