<html>
    <head>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
    </head>

    <body>
        <div class="container">
            <h1>List Post</h1>
            <table class = "table table-striped">
                <tbody>     
                    <tr>
                        <td>ID</td>
                        <td><?php echo $result['data']['id'] ?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $result['data']['employee_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Salary</td>
                        <td><?php echo $result['data']['employee_salary'] ?></td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td><?php echo $result['data']['employee_age'] ?></td>
                    </tr>
                    <tr>
                        <td>Profile Image</td>
                        <td><?php echo $result['data']['profile_image'] ?></td>
                </tbody>
            </table>
        </div>
    </body>
</html>