<style>
/* Loading Screen Styles */
#loadingScreen {
    display: none; /* Ensures it starts hidden */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    justify-content: center;
    align-items: center;
    font-size: 2rem;
    z-index: 1000;
}

/* Spinner styles */
.spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>

<div class="container mt-4">
        <div class="row">
<!-- Left Column -->
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5><?= department(); ?> Raised</h5>
                        <h3><?=$departmentCount['ticketCount']?></h3>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5>My Tickets</h5>
                        <h3><?= $userCount['username']?></h3>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5>Pending Tickets</h5>
                        <h3>_ _</h3>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5>Escalated Tickets</h5>
                        <h3>_ _ </h3>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-9">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Raise a Concern</h4>
                    </div>
                    <div class="card-body">
                        <form 
                            enctype="multipart/form-data" 
                            id="emailForm"
                            action="<?= route('new/ticket/save')?>" 
                            method="POST"
                            >

                        <?php foreach($ticketing_id as $id): 
                            $tid = $id['ticket_id'];?>
                        <?php endforeach;?>

                            <input type="hidden" name="ticketId" value="<?= "APSW-T" . ($tid + 1) ?>">
                            <input type="hidden" name="host" value="<?= clientHost() ?>">
                            <input type="hidden" name="email" value="<?= http\model\ModelData::addUserEmail() ?>">

                            <!-- Reason for Concern -->
                            <!-- <div class="mb-3">
                                <label for="category" class="form-label">Reason for Concern</label>
                                <select id="category" name="category" class="form-select">
                                    <option selected disabled value="">Choose a reason...</option>
                                    <?php foreach($parent as $reason): ?>
                                        <option value="<?= $reason['category']?>"><?= $reason['category']?></option>
                                    <?php endforeach;?>
                                    <option value="Other">Other</option>
                                </select>
                                <?php if(isset($errors['category'])):?>
                                    <div><small style="color:red"><?=$errors['category']?></small></div>
                                <?php endif;?>
                                
                            </div> -->

                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select id="department" name="department" class="form-select">
                                    <option selected disabled value="">Choose a department...</option>
                                    <?php foreach($ownDept as $deptmnt):?>
                                        <option value="<?=$deptmnt['department_name']?>"><?=$deptmnt['department_name']?></option>
                                    <?php endforeach;?>
                                </select>
                                <?php if(isset($errors['department'])):?>
                                    <div><small style="color:red"><?=$errors['department']?></small></div>
                                <?php endif;?>
                                
                            </div>

                            <!-- <div class="mb-3">
                                <label for="dept_email" class="form-label">Departmental Email</label>
                                <select id="dept_email" name="dept_email" class="form-select">
                                    <option selected disabled value="">Choose a department...</option>
                                    <?php foreach($ownDeptEmail as $depEmail):?>
                                        <option value="<?=$depEmail['email']?>"><?=$depEmail['department_name']?></option>
                                    <?php endforeach;?>
                                </select>
                                <?php if(isset($errors['dept_email'])):?>
                                    <div><small style="color:red"><?=$errors['dept_email']?></small></div>
                                <?php endif;?>
                                
                            </div> -->

                            <!-- <div class="mb-3">
                                <label for="sub_category" class="form-label">SubCategory Type</label>
                                <select id="sub_category" name="sub_category" class="form-select">
                                    <option selected disabled value="">Choose a sub-category...</option>
                                    <?php foreach($child as $sub): ?>
                                        <option value="<?= $sub['category']?>"><?= $sub['category']?></option>
                                    <?php endforeach;?>
                                    <option value="Other">Other</option>
                                </select>
                                <?php if(isset($errors['sub_category'])):?>
                                    <div><small style="color:red"><?=$errors['sub_category']?></small></div>
                                <?php endif;?>
                            </div> -->

                            <!-- Customer Name -->
                            <div class="mb-3">
                                <label for="summary" class="form-label">Subject/Summary</label>
                                <textarea type="text" class="form-control" id="summary" name="summary" class="form-control" rows="5" placeholder="EnterSummary"></textarea>
                                <?php if(isset($errors['summary'])):?>
                                    <div><small style="color:red"><?=$errors['summary']?></small></div>
                                <?php endif;?>
                            </div>

                            <!-- Priority Type -->
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select id="priority" name="priority" class="form-select">
                                    <option selected disabled value="">Choose a Priority...</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                                <?php if(isset($errors['priority'])):?>
                                    <div><small style="color:red"><?=$errors['priority']?></small></div>
                                <?php endif;?>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="5" placeholder="Describe your concern in detail"></textarea>
                                <?php if(isset($errors['description'])):?>
                                    <div><small style="color:red"><?=$errors['description']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="mt-2 mb-2">
                                <label for="upload_file">(optional) Attached screenshot</label>
                                <input type="file" class="form-control p-2 <?php if (isset($errors['upload_file']) ):?> is-invalid <?php endif;?>" name="upload_file" id="upload_file">
                                <?php if (isset($errors['upload_file']) ) :?>
                                    <div id="cm_serial" class="invalid-feedback"> <?= $errors['upload_file'] ?> </div>
                                <?php endif;?>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <!-- Loading Screen -->
                        <!-- <div id="loadingScreen">
                            <div class="spinner"></div>
                            Saving and Sending email, please wait...
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- <div id="loadingScreen" style="display: none;">Sending...</div> -->

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('emailForm').addEventListener('submit', function(event) {
            // event.preventDefault(); // Prevent default form submission
            
            // Ensure the form is properly filled before sending
            var form = this;
            if (!form.checkValidity()) {
                alert("Please fill out all required fields.");
                return;
            }

            // Show the loading screen AFTER form validation
            document.getElementById('loadingScreen').style.display = 'flex';

            // Collect form data
            var formData = new FormData(form);
            var actionUrl = form.getAttribute('action');
            var method = form.getAttribute('method');

            // Perform AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open(method, actionUrl, true);

            // Handle response from the PHP script
            xhr.onload = function() {
                // Hide the loading screen when email sending is done
                document.getElementById('loadingScreen').style.display = 'none';

                if (xhr.status === 200) {
                    window.location.href = "<?= route('dashboard') ?>";
                } else {
                    alert('Failed to send email. Please try again.');
                }
            };

            // Send the form data
            xhr.send(formData);
        });
    });
</script>  -->