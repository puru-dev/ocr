@extends('layouts.app')
@section('content')
<div class="container">
    @include('layouts.nav')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
              <div class="col-lg-12 margin-tb">
                  <div class="pull-left">
                      <h2>Employee List</h2>
                  </div>
                  <div class="pull-right">
                      <a class="btn btn-success" href="{{ route('employee.create') }}"> Create New Employee</a>
                  </div>
              </div>
            </div>
            <br>
            <div class="alert alert-success" style="display:none"></div>
            <table class="table table-bordered" id="myTable">
               <thead>
                  <tr>
                     <th>Sr No.</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Contact Number</th>
                     <th>Office Location</th>
                     <th>salary</th>
                     <th>IP of personal address</th>
                     <th>Cordinates of personal address</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody id="bodyData">
                <?php $i = 1; ?>
                @foreach ($Employee as $uData)
                  <tr>
                     <td>{{ $i }}</td>
                     <td>{{ $uData->name }}</td>
                     <td>{{ $uData->email }}</td>
                     <td>{{ $uData->contact_number }}</td>
                     <td>{{ $uData->office_location }}</td>
                     <td>{{ $uData->salary }}</td>
                     <td>{{ $uData->ip }}</td>
                     <td>{{ round($uData->latitude, 4).",".round($uData->longitude, 4) }}</td>
                     <td><label  class="switch" data="{{$uData->status}}" dataid="{{$uData->id}}"><input  type="checkbox" {{$uData->status==1?"checked" :""}}><span class="slider round"></span></label></td>
                     <td>
                          <a class="btn btn-success" href="{{ route('employee.show',$uData->id) }}">View</a>
                          <a class="btn btn-primary" href="{{ route('employee.edit',$uData->id) }}">Edit</a>
                          <!-- SUPPORT ABOVE VERSION 5.5 -->
                          {{-- @csrf
                          @method('DELETE') --}} 
                          
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
            
                          <button  type="submit" class="btn btn-danger delete" value='{{$uData->id}}'>Delete</button>
                  </td>
                  </tr>
                  <?php $i++; ?>
                  @endforeach
               </tbody>
            </table>

        </div>
    </div>
</div>
<script type="text/javascript">
  $(document).on("click", ".delete", function() { 
        var $ele = $(this).parent().parent();
        var id= $(this).val();
        var url = "{{URL('employee/destroy')}}";
        var dltUrl = url+"/"+id;
        $.ajax({
          url: dltUrl,
          type: "DELETE",
          cache: false,
          data:{
            _token:'{{ csrf_token() }}'
          },
          cache: false,
          dataType: 'json',
          success: function(dataResult){
            var resultData = dataResult.data;
            $("#bodyData").html("");
            var bodyData = '';
            var i=1;
            $.each(resultData,function(index,row){
                var url1 = "{{URL('employee')}}";
                var editUrl = url1+"/edit"+'/'+row.id;
                var viewUrl = url1+"/show"+'/'+row.id;
                var id=row.id--;
                if(row.status==1){
                  var status="checked";
                }else{
                  var status="";
                }
                bodyData+="<tr>"
                bodyData+="<td>"+row.id+"</td><td>"+row.name+"</td><td>"+row.email+"</td><td>"+row.contact_number+"</td><td>"+row.office_location+"</td><td>"+row.salary+"</td><td>"+row.ip+"</td><td>"+row.latitude+','+row.longitude+"</td>"+
                "<td><label  class='switch' data="+row.status+" dataid="+row.id+"><input  type='checkbox' "+status+" ><span class='slider round'></span></label></td>"
                +"<td><a class='btn btn-success' href='"+viewUrl+"'>View</a><a class='btn btn-primary' href='"+editUrl+"'>Edit</a>"+
                "<button class='btn btn-danger delete' value='"+id+"' style='margin-left:20px;'>Delete</button></td>";
                bodyData+="</tr>";
            })
            $("#bodyData").append(bodyData);
            jQuery('.alert-success').show();
            jQuery('.alert-success').append('<p>Record Deleted Successfully</p>');
          }
        });
  });
  $(document).on("change", ".switch", function() { 
        var status=$(this).attr('data');
        var id=$(this).attr('dataid');
        var url = "{{URL('employee/status_change')}}";
        var statusUrl = url+"/"+id;
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
       });
        $.ajax({
          url: statusUrl,
          type: "patch",
          cache: false,
          data:{
            status: status,
          },
          cache: false,
          dataType: 'json',
          success: function(dataResult){
            alert(dataResult.success);
            location.reload(true);
          }
        });
  });
</script>
@endsection
