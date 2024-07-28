<?php
// Include Database Here
include "database.php";
$obj = new Database();

// Insert Data
if (isset($_POST['submit'])){
    $obj->InsertData($_POST);
}

// Delete Data
if (isset($_GET['deleteid'])){
    $delid = $_GET['deleteid'];
    $obj->DeleteDat($delid);
}

// Update Data
if (isset($_POST['update'])){
    $obj->UpdateData($_POST);
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap Min CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

</head>

<body>


<section id="contact-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact-form mt-5">
                    <h1 class="text-center mb-5">PHP OOP CRUD</h1>
                    <!-- Success message -->
                    <?php
                    if (isset($_GET['msg']) and $_GET['msg'] == 'ins') {
                        echo '<div class="alert alert-primary" role="alert">
            Record inserted seccessfully!
         </div>';
                    }
                    if (isset($_GET['msg']) and $_GET['msg'] == 'ups') {
                        echo '<div class="alert alert-info" role="alert">
        Record Updated seccessfully!
        </div>';
                    }
                    if (isset($_GET['msg']) and $_GET['msg'] == 'del') {
                        echo '<div class="alert alert-danger" role="alert">
                Record Deleted seccessfully!
                </div>';
                    }

                    ?>
                    <?php
                    if (isset($_GET['editid'])){
                        $editid = $_GET['editid'];
                        $myrecord = $obj->DisplayDataById($editid);
                       ?>
                        <form id="contactForm" class="contact-form form" action="index.php" method="post">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" value="<?php echo $myrecord['name']?>" class="form-control" placeholder="Your Name" required>
                                        <p id="nameStatus" class="formError"></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" value="<?php echo $myrecord['email']?>" id="email" class="form-control" placeholder="Your Email" required>
                                        <p id="emailStatus" class="formError"></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="number" name="phone" value="<?php echo $myrecord['phone']?>" id="phone" class="form-control"
                                               placeholder="Your Phone" required>
                                        <p id="phoneStatus" class="formError"></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="subject" value="<?php echo $myrecord['subject']?>" id="subject" class="form-control"
                                               placeholder="Your Subject" required>
                                        <p id="subjectStatus" class="formError"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" value="<?php echo $myrecord['message']?>" id="message" cols="30" rows="6" placeholder="<?php echo $myrecord['message']?>"></textarea>
                                        <p id="messageStatus" class="formError"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <input type="hidden" name="hid" value="<?php echo $myrecord['id']?>">
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" name="update" class="default-btn btn-lg submit-btn">Update</button>
                                </div>
                            </div>
                            <div class="status-message"></div>
                        </form>

                    <?php
                    }else{
                    ?>
                    <form id="contactForm" class="contact-form form" action="index.php" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                                    <p id="nameStatus" class="formError"></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                                    <p id="emailStatus" class="formError"></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="number" name="phone" id="phone" class="form-control"
                                           placeholder="Your Phone" required>
                                    <p id="phoneStatus" class="formError"></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="subject" id="subject" class="form-control"
                                           placeholder="Your Subject" required>
                                    <p id="subjectStatus" class="formError"></p>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" required id="message" cols="30" rows="6" placeholder="Your Message"></textarea>
                                    <p id="messageStatus" class="formError"></p>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <button type="submit" name="submit" class="default-btn btn-lg submit-btn">Send Message</button>
                            </div>
                        </div>
                        <div class="status-message"></div>
                    </form>
                    <?php
                    }
                    ?>

                    <h4 class="text-center text-danger mt-5">Display Records</h4>
                    <table class="table table-bordered">
                        <tr class="text-center bg-primary text-white">
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $data = $obj->DisplayData();
                        $sno  = 1;
                        foreach ($data as $value){
                            ?>
                        <tr>
                            <td><?php echo $value['id']?></td>
                            <td><?php echo $value['name']?></td>
                            <td><?php echo $value['email']?></td>
                            <td><?php echo $value['phone']?></td>
                            <td><?php echo $value['subject']?></td>
                            <td><?php echo $value['message']?></td>
                            <td>
                                <a href="index.php?editid=<?php echo $value['id']?>" class="btn btn-info">Edit</a>
                                <a href="index.php?deleteid=<?php echo $value['id']?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>

                        <?php
                        }


                        ?>

                    </table>


                </div>
            </div>
        </div>
    </div>
</section>
<!---------------End-contact-section---------------------->




<!-- jQuery Min JS -->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap Min JS -->
<script src="assets/js/bootstrap.min.js"></script>

</body>

</html>