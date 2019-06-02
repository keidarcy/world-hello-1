@extends('layouts.app')


@section('content')
  <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>

  <div align="center">
      <h1>タイトル：{{ $questionnaire->title }}の</h1></br>
      @foreach($questions as $question)
        <h2>
          @if($question->mtb_question_type_id==1||$question->mtb_question_type_id==2||$question->mtb_question_type_id==3)
            {{ $question->number }}:{{ $question->question }}
          @endif
        </h2>
        {{-- @php dd($questionnaire->count_people_for_single() ) @endphp --}}
          @if($question->mtb_question_type_id==1||$question->mtb_question_type_id==2||$question->mtb_question_type_id==3)
              <table border="1">
                  <tr align="center">
                    <th>選択肢</th>
                    <th>人数</th>
                    <th>総人数</th>
                    <th>％</th>
                  </tr>

                  @php  $percent_for_multi=[] @endphp
                  @php  $percent_for_single=[] @endphp
                  @php  $percent_for_select=[] @endphp


                  @php  $for_charts=[] @endphp

                  @foreach($question->choices as $index=>$choice)
                  <tr align="center">
                    <td>{{ $choice->choice }}</td>

                    {{-- @php  $for_charts[]=$choice->choice @endphp --}}

                    <td>

                      @if($question->mtb_question_type_id==1)
                          @php $not_found = true @endphp
                              @php $answer_people_with=[] @endphp
                                  @foreach($questionnaire->count_people_for_multi() as $answer_key => $answer_people)
                                        @if($choice->id == $answer_key)
                                           @php $answer_people_with[]=$answer_people @endphp
                                           @php $not_found = false @endphp
                                        @endif
                                  @endforeach

                                  @if($not_found)
                                    @php $answer_people_with[]=0 @endphp
                                  @endif

                                  @foreach($answer_people_with as $value)
                                    {{  $value }}
                                      @php $percent_for_multi[] = sprintf("%.2f%%", $value/$questionnaire->count_max_people() * 100) @endphp
                                      @php $for_charts[$choice->choice] = (int)sprintf("%01.1f", $value/$questionnaire->count_max_people() * 100) @endphp

                                  @endforeach
                      @endif




                      @if($question->mtb_question_type_id==2)
                          @php $not_found = true @endphp
                              @php $answer_people_with=[] @endphp
                                  @foreach($questionnaire->count_people_for_single() as $answer_key => $answer_people)
                                        @if($choice->id == $answer_key)
                                           @php $answer_people_with[]=$answer_people @endphp
                                           @php $not_found = false @endphp
                                        @endif
                                  @endforeach

                                  @if($not_found)
                                    @php $answer_people_with[]=0 @endphp
                                  @endif

                                  @foreach($answer_people_with as $value)
                                    {{  $value }}
                                      @php $percent_for_single[] = sprintf("%.2f%%", $value/$questionnaire->count_max_people() * 100) @endphp
                                      @php $for_charts[$choice->choice] = (int)sprintf("%01.1f", $value/$questionnaire->count_max_people() * 100) @endphp
                                  @endforeach
                      @endif








                      @if($question->mtb_question_type_id==3)
                          @php $not_found = true @endphp
                              @php $answer_people_with=[] @endphp
                                  @foreach($questionnaire->count_people_for_select() as $answer_key => $answer_people)
                                        @if($choice->id == $answer_key)
                                           @php $answer_people_with[]=$answer_people @endphp
                                           @php $not_found = false @endphp
                                        @endif
                                  @endforeach

                                  @if($not_found)
                                    @php $answer_people_with[]=0 @endphp
                                  @endif

                                  @foreach($answer_people_with as $value)
                                    {{  $value }}
                                      @php $percent_for_select[] = sprintf("%.2f%%", $value/$questionnaire->count_max_people() * 100) @endphp
                                      @php $for_charts[$choice->choice] = (int)sprintf("%01.1f", $value/$questionnaire->count_max_people() * 100) @endphp


                                  @endforeach
                      @endif



                    </td>
                    <td>{{ $questionnaire->count_max_people() }}</td>

                    <td>
                        @if($question->mtb_question_type_id==1)
                            {{ $percent_for_multi[$index] }}
                        @endif

                        @if($question->mtb_question_type_id==2)
                            {{ $percent_for_single[$index] }}
                        @endif

                        @if($question->mtb_question_type_id==3)
                            {{ $percent_for_select[$index] }}
                        @endif
                    </td>

                  </tr>

                @endforeach
              </table>
            @if($question->mtb_question_type_id==1)
            <div class="column_{{ $question->id }}" style="width: 550px; height: 400px; margin: 0 auto"></div>
            <script language="JavaScript">
            $(document).ready(function() {
               var chart = {
                  type: 'column'
               };
               var title = {
                  text: '{{ $question->question }}'
               };
               var subtitle = {
                  text: 'Source: hi~.com'
               };
               var xAxis = {
                  categories: [
                    @foreach($for_charts as $index => $for_chart)
                      @if($question->mtb_question_type_id==1)
                         '{{ $index }}',
                      @endif
                    @endforeach
                  ],
                  crosshair: true
               };
               var yAxis = {
                  min: 0,
                  title: {
                     text: '％'
                  }
               };
               var tooltip = {
                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                     '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
               };
               var plotOptions = {
                  column: {
                     pointPadding: 0.2,
                     borderWidth: 0
                  }
               };
               var credits = {
                  enabled: false
               };

               var series= [{
                        name: 'Tokyo',
                        data: [
                          @foreach($for_charts as $index => $for_chart)
                            @if($question->mtb_question_type_id==1)
                               {{ $for_chart }},
                            @endif
                          @endforeach
                        ]
               }];

               var json = {};
               json.chart = chart;
               json.title = title;
               json.subtitle = subtitle;
               json.tooltip = tooltip;
               json.xAxis = xAxis;
               json.yAxis = yAxis;
               json.series = series;
               json.plotOptions = plotOptions;
               json.credits = credits;
               $('.column_{{ $question->id }}').highcharts(json);

            });
            </script>
            @endif

              @if($question->mtb_question_type_id==2||$question->mtb_question_type_id==3)
              <div class="pie_{{ $question->id }}" style="width: 550px; height: 400px; margin: 0 auto"></div>
              <script language="JavaScript">
              $(document).ready(function() {
                 var chart = {
                     plotBackgroundColor: '#FCFFC5',
                     plotBorderWidth: null,
                     plotShadow: false
                 };
                 var title = {
                    text: '{{ $question->question }}'
                 };
                 var tooltip = {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                 };
                 var plotOptions = {
                    pie: {
                       allowPointSelect: true,
                       cursor: 'pointer',
                       dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}%</b>: {point.percentage:.1f} %',
                          style: {
                             color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                          }
                       }
                    }
                 };
                 var series= [{
                    type: 'pie',
                    name: 'hello kei',
                    data: [
                      @foreach($for_charts as $index => $for_chart)
                        @if($question->mtb_question_type_id==2)
                           ['{{ $index }}',  {{ $for_chart }}],
                        @endif
                      @endforeach
                      @foreach($for_charts as $index => $for_chart)
                        @if($question->mtb_question_type_id==3)
                           ['{{ $index }}',  {{ $for_chart }}],
                        @endif
                      @endforeach

                    ]
                 }];

                 var json = {};
                 json.chart = chart;
                 json.title = title;
                 json.tooltip = tooltip;
                 json.series = series;
                 json.plotOptions = plotOptions;
                 $('.pie_{{ $question->id }}').highcharts(json);
              });
              </script>
            @endif

          @endif
        @endforeach

    </div>






@endsection
