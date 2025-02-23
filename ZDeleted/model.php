<?php

class model{

    public function edit_applicant()
        {
            include("dbAccess.php");
            $db = new DBOperations();

            if (isset($_POST['update'])) {
                if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['dOfEmp'])) {
                    if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['email']) && !empty($_POST['dOfEmp'])) {

                        $ID = $_POST['id'];
                        $TutorName = $_POST['name'];
                        $TutorAddress = $_POST['address'];
                        $TutorEmail = $_POST['email'];
                        $TutorDofEmployment = $_POST['dOfEmp'];

                        $query = "UPDATE `detailsoftutor` SET `tutorName`='$TutorName',`tutorAddress`='$TutorAddress',`tutorEmail`='$TutorEmail',`tutorDofEmp`='$TutorDofEmployment' WHERE `staffNumber`= $ID";

                        if ($this->$db->query($query)) {
                            echo "<script>alert(' Update Successfully');</script>";
                            //header('Location: http://localhost/Management_System/index.php');
                            echo "<script>window.location.href='view.php';</script>";
                            //-------metrhana karanneth kalin form eke php eke karapu wademai..enam data eka insert kalata passe ayema index ekata yanna oni kyala...
                        } else {
                            echo "<script>alert('Record update Faild.')</script>";
                            echo "<script>window.location.href='index copy.php';</script>";
                        }
                    } else {
                        echo "<script>alert('Some fields can be empty.')</script>";
                        echo "<script>window.location.href='index copy.php';</script>";
                    }
                } else {
                    echo "<script>alert('variables not set.')</script>";
                }
            }
        }

}