@extends($activeTemplate.'layouts.frontend')

@section('content')

    @include($activeTemplate.'partials.breadcrumb')

    <section class="about-section pt-60 pb-60 bg--section">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-12">
                    <div class="about-content pt-60 pb-60">
                        <div class="section__header">
                          
                            <div class="policy-content">
                              <p> CÓMO JUGAR EL JUEGO
VIPHOTBET es una empresa de inversión deportiva enfocada en permitir que los miembros alcancen la libertad financiera a través de sus oportunidades de inversión VIP.
<br/>
VIPHOTBET Investment Platform utiliza un sistema y software de análisis de big data para tomar decisiones basadas en datos, brindando a los inversores "bajo riesgo y alto retorno de la inversión", VIPHOTBET ha estado en funcionamiento durante más de 10 años. Su ámbito de inversión abarca la banca de inversión, las finanzas, los valores, los deportes, el entretenimiento y otros campos.
<br/>
Por ejemplo: El resultado de un partido de fútbol es 3:0. Si un miembro invierte en un proyecto que no sea "3:0" antes del partido, la inversión puede ser rentable.
<br/>
En la plataforma de inversión VIPHOTBET, cada juego proporciona un total de 18 puntos de puntuación comunes como: 0:0, 1:0, 1:1,1:2, 0:1, 0:2, 2:2... etc. .
<br/>
Solo puede elegir un elemento de puntaje para invertir, incluso cuando el resultado del juego es diferente de su elección invertida, aún gana dinero y la probabilidad de ganancia es del 94.44%.
</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .policy-content *{
            color: #FFFFFF !important;
        }
    </style>
@endpush
