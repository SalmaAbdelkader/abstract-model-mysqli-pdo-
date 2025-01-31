<?php  
      include "user.model.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form and Table Page</title>
    <link rel="stylesheet" href="layout/css/style.css">
    <link rel="stylesheet" href="layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="layout/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout/css/jquery-ui.css">
    <link rel="stylesheet" href="layout/css/jquery.selectBoxIt.css">
</head>
<body>
    <header>
        <h1>Form For Adding Employee</h1>
    </header>
    <div class="container">
      <p>  <?php  
            (isset($_SESSION['msg'])) ? $_SESSION['msg'] : '';
            session_unset();
        ?>
    </p>
        <form id="data-form"  method="post" action="user.model.php">
            <input type="hidden" id="id" name="user_id"  value = "<?= isset($user) ? $user->id : ''  ?>" required>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" value = "<?= isset($user) ? $user->name : ''  ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value = "<?= isset($user) ? $user->email : ''  ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" placeholder="Enter your age" min="18" max="60" value = "<?= isset($user) ? $user->age : ''  ?>" required>
            </div>
            <div class="form-group">
                <label for="password">password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" value = "<?= isset($user) ? $user->password : ''  ?>" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter your address" value = "<?= isset($user) ? $user->address : ''  ?>" required>
            </div>

            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" id="salary" name="salary" placeholder="Enter your salary" min="1500" value = "<?= isset($user) ? $user->salary : ''  ?>" max="20000" required>
            </div>

            <div class="form-group">
                <label for="tax">Tax( % ):</label>
                <input type="float" id="tax" name="tax" placeholder="Enter your tax" min="0.1" max="5" value = "<?= isset($user) ? $user->tax : ''  ?>" required>
            </div>

            <div class="form-group">
                <button type="submit" name="submit">Save</button>
            </div>
        </form>


        <!-- Showing data  -->

        <table id="data-table">
            <h1>Data Table</h1>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Tax( % )</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php  
                    
                    $data = view();
                    if($data !== false):
                        foreach( view() as $user): 
                        
                         ?>
                <tr>
                                <td><?= $user->name; ?></td>
                                <td><?= $user->email; ?></td>
                                <td><?= $user->age; ?></td>
                                <td><?= $user->address; ?></td>
                                <td><?= $user->calcSalary();  ?></td>
                                <td><?= $user->tax; ?></td>
                                <td>
                                    <a href="?action=edit&user_id=<?= $user->id; ?>" class="btn btn-success"><i class="fa fa-edit icon"></i> Edit</a>
                                    <a href="?action=delete&user_id=<?= $user->id; ?>" onclick="if(!confirm('Do You Want To Delete This User ?')) return false;" class="btn btn-danger "><i class="fa fa-close icon"></i> Delete</a>
                                </td>
                </tr>
                <?php 
                        endforeach;
                    endif;
                 ?>
            </tbody>
        </table>
    </div>
</body>
</html>
