<!DOCTYPE html>
<html lang="pl">
  <html>
    <head>
      <title>Rekrutacja - Wrocław</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta name="description" content="Zadanie rekrutacyjne">
      <meta name="author" content="Daniel Majchrzak">
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link 
        type="text/css" 
        rel="stylesheet" 
        href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css"  
        media="screen,projection"/>      
        <link 
        type="text/css" 
        rel="stylesheet" 
        href="//cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.css"/>

      <link 
        type="text/css" 
        rel="stylesheet" 
        href="{{ asset('css/main.css') }}"/>
    </head>
    <body>
      <div class='container'>
        <div class="row">
          <div class="col s12">
            <div class="card">
              <div class="card-action">
                <div class='row no-margin-bottom'>
                  <div class='col s12'>
                    <a  
                      class="waves-effect waves-light btn left right-margin"
                      href='{{ route('codes') }}'><i class="material-icons left">view_list</i>Lista</a>
                    <form 
                      action='{{ route('codes.store') }}'
                      method='POST'>
                      {{ csrf_field() }}
                      <button 
                        type='submit' 
                        class="waves-effect waves-light btn left"><i class="material-icons left">add</i>Dodaj</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="card-action">
                <form 
                  onsubmit="return confirm('Czy jesteś pewny?')"
                  action='{{ route('codes.destroy') }}'
                  method='POST'>
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <div class='row'>
                    <div class='col s12'>
                      <select 
                        multiple
                        id="remove-codes" 
                        class="selectized" 
                        placeholder="Wpisz lub wybierz kod" 
                        tabindex="-1" 
                        style="display: none;"
                        name='remove_codes[]'>
                          @foreach (array_merge((is_array(old('remove_codes'))) ? 
                            old('remove_codes') : [], \App\Models\Code::get()
                            ->map(function($item) {
                              return $item->code;
                            })->toArray()) as $code)
                          <option value='{{ $code }}' {{ (old('remove_codes') 
                            && is_array(old('remove_codes'))
                            && in_array($code, old('remove_codes'))) ?
                              'selected=\'selected\'' : '' }}>{{ $code }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col s12'>
                      <button 
                        type='submit' 
                        class="waves-effect waves-light btn left"><i class="material-icons left">remove</i>Usuń</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <div class="card">
              <div class="card-content">
                <span class="card-title">Kody</span>
                @if ($codes->count() > 0)
                  <table class="bordered centered striped"> 
                    <thead>
                      <tr>
                          <th>Kod</th>
                          <th>Data utworzenia</th>
                      </tr>
                    </thead>
                      <tbody>
                      @foreach ($codes as $code)
                      <tr>
                        <td>{{ $code->code }}</td>
                        <td>{{ $code->created_at }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                @else
                  <p class='center-align'>Brak Wyników do wyświetlenia</p>
                @endif
              </div>
            </div>
          </div>
        </div>
        @if ($codes->lastPage() > 1)
          <div class='row'>  
            <div class="col s12">   
                <ul class="pagination center-align">
                    <li class="{{ ($codes->currentPage() == 1) ? ' disabled' : '' }}">
                        <a href="{{ $codes->url(1) }}"><i class="material-icons">chevron_left</i></a>
                    </li>
                    @for ($i = 1; $i <= $codes->lastPage(); $i++)
                        <li class="{{ ($codes->currentPage() == $i) ? ' active' : '' }} waves-effect">
                            <a href="{{ $codes->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="{{ ($codes->currentPage() == $codes->lastPage()) ? ' disabled' : '' }}">
                        <a href="{{ $codes->url($codes->currentPage()+1) }}" ><i class="material-icons">chevron_right</i></a>
                    </li>
                </ul> 
            </div>  
          </div>  
        @endif 
      </div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
      <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {

          $('#remove-codes').selectize({
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            },
            sortField: 'text',
          });
          @if (session('success'))
            Materialize.toast({!! json_encode(session('success')) !!}, 4000)
          @endif

          @if (session('errorMessage'))
            Materialize.toast({!! json_encode(session('errorMessage')) !!}, 8000, 'red white-text')
          @endif          
        })
      </script>
    </body>
  </html>
        