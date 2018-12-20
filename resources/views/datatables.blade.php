@extends('main.main')
@section('content')
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Datatables Jquery Plugin with Php MySql and Bootstrap</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
      </head>  
      <body>  
           <br /><br />  
           <div class="container">  
                <h3 align="center">Datatables from login</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Name</td>  
                                    <td>Email</td>  
                                    <td>password</td>   
                               </tr>  
                          </thead>
                          <tbody>
                          @php $i = 0 @endphp
                          @foreach($user as $val)
                                @php  
                                        $i++;
                                @endphp
                                @if($i <= 8 )
                                <tr>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->email}}</td>
                                    <td>{{$val->password}}</td>
                                </tr>
                                @endif
                                
                               
                            @endforeach
                          </tbody>   
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 
 @endsection

 @section('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
   <script>
            $(document).ready( function () {
                $('#employee_data').DataTable();
            } );

   </script>
 @endsection