<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.jqueryui.min.css"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Styles -->
<style>
    body {
    font-family: 'Lato', sans-serif;
    }
h1 {
    margin-bottom: 40px;
}
label {
    color: #333;
}
.btn-send {
    font-weight: 300;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    width: 80%;
    margin-left: 3px;
    }
.help-block.with-errors {
    color: #ff5050;
    margin-top: 5px;

}
.card{
	margin-left: 10px;
	margin-right: 10px;
}
</style>
</head>
    <body class="antialiased">
        <div class="container">
            <div class=" text-center mt-5 ">
                <h1>Student Form</h1>
            </div>
        <div class="row ">
          <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                <div class = "container">
                    <form id="student-form" role="form" enctype="multipart/form-data">
                <div class="controls">
                    <div id="validation-errors"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_name">Name *</label>
                                <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter Name *" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_roll">Roll No. *</label>
                                <input id="form_roll" type="text" name="roll_number" class="form-control" placeholder="Please enter Roll Number *" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_class">Class *</label>
                                <select id="form_class" name="class" class="form-control" required="required">
                                    <option value="">Select Class</option>
                                    @for($c=1;$c<=12;$c++)
                                    <option value="{{$c}}">{{$c}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_photo">Student's Photo *</label>
                                <input id="form_photo" type="file" name="photo" class="form-control" accept="image/*" required="required">
                            </div>
                        </div>
                    </div>
                    <h6>Marks</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input id="form_name" type="number" name="english" class="form-control" placeholder="English *" required="required">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input id="form_name" type="number" name="hindi" class="form-control" placeholder="Hindi *" required="required">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input id="form_name" type="number" name="maths" class="form-control" placeholder="Maths *" required="required">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input id="form_name" type="number" name="science" class="form-control" placeholder="Science *" required="required">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input id="form_name" type="number" name="social_studies" class="form-control" placeholder="Social Studies *" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-success btn-send  pt-2 btn-block" value="Submit">
                        </div>
                    </div>
            </div>
             </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    <hr>
    <div class="row mt-5 mb-5">
        <div class="col">
            <h4 class="text-center p-2">Students List</h4>
            <div class="" >
                <table class="table" id="stu_list">
                    <thead>
                        <tr>
                            <th>Roll No.</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Class</th>
                            <th>English</th>
                            <th>Hindi</th>
                            <th>Maths</th>
                            <th>Science</th>
                            <th>Social Science</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div>
    </body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#student-form').on('submit', function(e) {
        $('#validation-errors').html("");
        e.preventDefault();
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': '{{csrf_token()}}',
          }
        });
        var formData = new FormData(this);
        $.ajax({
            url: "{{route('saveStudent')}}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.success){
                    alert(response.success);
                    $("#student-form")[0].reset()
                    $("#stu_list").dataTable().fnDestroy();
                    loadData();
                }
                if(response.error){
                    $.each(response.error, function(key,value) {
                        $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
                    });
                }
            },
        });
    });
    loadData();
    //Datatable
    function loadData() {
        $('#stu_list').DataTable({
            processing: true,
            serverSide: true,
            searching:false,
            lengthMenu: [10, 25, 50, 100],
            "ajax": {
                "url": "{{route('getStudentsList')}}",
                "dataType": "json",
                "type": "post",
                data: {
                    '_token': '{{csrf_token()}}',
                },
            },
            'order': [
                [0, 'desc']
            ],
            columns: [

                {
                    data: 'roll_num'
                },
                {
                    data: 'name'
                },
                {
                    data: 'photo',
                    orderable: false,
                },
                {
                    data: 'class',
                    orderable: false,
                },
                {
                    data: 'english'
                },
                {
                    data: 'hindi'
                },
                {
                    data: 'maths'
                },
                {
                    data: 'science'
                },
                {
                    data: 'social_science'
                },

            ],
        });
    }
});
    </script>
</html>
