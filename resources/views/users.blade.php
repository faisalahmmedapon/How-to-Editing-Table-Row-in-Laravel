<!DOCTYPE html>

<html>

<head>

    <title>Laravel Table Inline Editing </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css"
        rel="stylesheet" />

    <script>
        $.fn.poshytip = {
            defaults: null
        }
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js">
    </script>

</head>

<body>



    <div class="container">


        <table class="table table-bordered data-table">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Name</th>

                    <th>Email</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($users as $user)
                    <tr>

                        <td>{{ $user->id }}</td>

                        <td>

                            <a href="" class="update" data-name="name" data-type="text"
                                data-pk="{{ $user->id }}" data-title="Enter name">{{ $user->name }}</a>

                        </td>

                        <td>

                            <a href="" class="update" data-name="email" data-type="text"
                                data-pk="{{ $user->id }}" data-title="Enter email">{{ $user->email }}</a>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>



</body>



<script type="text/javascript">
    $.fn.editable.defaults.mode = 'inline';



    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': '{{ csrf_token() }}'

        }

    });



    $('.update').editable({

        url: "{{ route('users.update') }}",

        type: 'text',

        pk: 1,

        name: 'name',

        title: 'Enter name'

    });
</script>

</html>
