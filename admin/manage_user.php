<?php 
include('db_connect.php');
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM student where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">

    <form action="" id="manage-user">
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" name="name" id="name" class="form-control"
                value="<?php echo isset($meta['firstName']) ? $meta['firstName']: '' ?>" required>
            
                <label for="name">Last Name</label>
            <input type="text" name="name" id="name" class="form-control"
                value="<?php echo isset($meta['lastName']) ? $meta['lastName']: '' ?>" required>


        </div>
        <div class="form-group">
            <label for="username">Email</label>
            <input type="text" name="username" id="username" class="form-control"
                value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control"
                value="<?php echo isset($meta['password']) ? $meta['password']: '' ?>" required>
        </div>
    </form>
</div>
<script>
function validateForm() {
    var form = document.getElementById("manage-user");
    var requiredFields = form.querySelectorAll('[required]');

    for (var i = 0; i < requiredFields.length; i++) {
        if (requiredFields[i].value.trim() === "") {
            alert("Please fill in all required fields before saving.");
            console.log("Form not submitted.");
            allowFormSubmission = false;
            location.reload(); // Set to false if validation fails
            return;
        }
    }

    allowFormSubmission = true; // Set to true if validation succeeds
}
$('#manage-user').submit(function(e) {
    e.preventDefault();
    start_load();
    validateForm();

    if (allowFormSubmission) {
        $.ajax({
            url: 'ajax.php?action=save_user',
            method: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully saved", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)
                }
            }
        })
    }
})
</script>