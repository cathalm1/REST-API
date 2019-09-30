<!DOCTYPE html>
<html>
<head>
    <title>RESTFUL API</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
</head>
<body>
<div class="container">
    <br />

    <h3 align="center">RESTFUL API</h3>
    <br />
    <div align="right" style="margin-bottom:5px;">
        <button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Name</th>
                <th>URL</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="api_crud_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Data</h4>
                </div>
                <div class="modal-body">
                    <!--<div class="form-group">
                        <label>Enter Date</label>
                        <input type="text" name="u_date" id="u_date" class="form-control" />
                    </div>-->
                    <div class="form-group">
                        <label>Enter Name</label>
                        <input type="text" name="u_name" id="u_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter URL</label>
                        <input type="text" name="u_url" id="u_url" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Description</label>
                        <input type="text" name="u_description" id="u_description" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="insert" />
                    <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="insert" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--GET single id-->
<div id="GETS">
	<input type="text" name="getIDn" id="getIDn">
	<button type="submit" value="submit">Display Single ID</button>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        fetch_data();

        function fetch_data()
        {
            $.ajax({
                url:"SelectData.php",
                success:function(data)
                {
                    $('tbody').html(data);
                }
            })
        }

        $('#add_button').click(function(){
            $('#action').val('insert');
            $('#button_action').val('insert');
            $('.modal-title').text('Add Data');
            $('#apicrudModal').modal('show');
        });

        $('#api_crud_form').on('submit', function(event){
            event.preventDefault();
            /*if($('#u_date').val() === '') {
                alert("Enter Date");
            }*/
            if($('#u_name').val() === '') {
                alert("Enter Name");
            }
            else if($('#u_url').val() === '') {
                alert("Enter URL");
            }
            else if($('#u_description').val() === '') {
                alert("Enter Description");
            }
            else
            {
                var form_data = $(this).serialize();
                //console.log(" data  1.1 ==  " + form_data);

                $.ajax({
                    url:"Method.php",
                    method:"POST",
                    data:form_data,
                    success:function(data)
                    {
                        //console.log(" data  1.2 ==  " + data);

                        fetch_data();
                        $('#api_crud_form')[0].reset();
                        $('#apicrudModal').modal('hide');
                        if(data === 'insert')
                        {
                            alert("Data Inserted using PHP API");
                        }
                        if(data === 'update')
                        {
                            alert("Data Updated using PHP API");
                        }
                    }
                });
            }
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            var action = 'fetch_single';

            $.ajax({
                url:"Method.php",
                method:"POST",
                data:{id:id, action:action},
                dataTypes:"json",
                success:function(data)
                {
                    data = JSON.parse(data);
                    $('#hidden_id').val(data['id']);
                    $('#u_date').val(data['date']);
                    $('#u_name').val(data['name']);
                    $('#u_url').val(data['url']);
                    $('#u_description').val(data['description']);
                    $('#action').val('update');
                    $('#button_action').val('Update');
                    $('.modal-title').text('Edit Data');
                    $('#apicrudModal').modal('show');
                }
            })
        });

        $(document).on('click', '.delete', function(){
            var id = $(this).attr("id");
            var action = 'delete';
            if(confirm("Are you sure you want to remove this data using PHP API?"))
            {
                $.ajax({
                    url:"Method.php",
                    method:"POST",
                    data:{id:id, action:action},
                    success:function(data)
                    {
                        fetch_data();
                        alert("Data Deleted using PHP API");
                    }
                });
            }
        });


	  $('#GETS').on('click', function(){
            var id = $('#getIDn').val();
            var action = 'fetch_single';

            $.ajax({
                url:"Method.php",
                method:"POST",
                data:{id:id, action:action},
                dataTypes:"json",
                success:function(data)
                {
                    data = JSON.parse(data);
		    out = data['id'] + " " + data['id'] + " " + data['date'] + " " + data['name'] + " " + data['url'] + " " + data['description'];
		    alert(out);
                }
            })
        });

    });
</script>
