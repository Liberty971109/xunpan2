<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import</title>
</head>
<body>
    
    <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            Import
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="{{route('ask.import')}}">
                                @csrf
                                <div class="form group">
                                    <label for="file">Choose CSV</label>
                                    <input type="file" name="file" class="form-contol" />
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>