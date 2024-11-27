<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php if ($role === 'employer'): ?>
      <div class="container mt-5">
                <!-- Button to Open Modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#jobPostModal">
                    Post a Job
                </button>

                <!-- Job Post Modal -->
                <div class="modal fade" id="jobPostModal" tabindex="-1" aria-labelledby="jobPostModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="jobPostModalLabel">Post a Job</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="jobPostForm" method="POST" action="<?= site_url('user/employer/job-post'); ?>">
                                    <!-- Job Title -->
                                    <div class="mb-3">
                                        <label for="jobTitle" class="form-label">Job Title</label>
                                        <input type="text" class="form-control" id="jobTitle" name="title" required>
                                    </div>

                                    <!-- Job Description -->
                                    <div class="mb-3">
                                        <label for="jobDescription" class="form-label">Job Description</label>
                                        <textarea class="form-control" id="jobDescription" name="description" rows="3" required></textarea>
                                    </div>

                                    <!-- Other Form Fields -->
                                    <div class="mb-3">
                                        <label for="jobRequirements" class="form-label">Requirements</label>
                                        <textarea class="form-control" id="jobRequirements" name="requirements" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jobLocation" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="jobLocation" name="location" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jobSalary" class="form-label">Salary</label>
                                        <input type="text" class="form-control" id="jobSalary" name="salary" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jobType" class="form-label">Job Type</label>
                                        <select class="form-select" id="jobType" name="job_type" required>
                                            <option value="full-time">Full-time</option>
                                            <option value="part-time">Part-time</option>
                                            <option value="remote">Remote</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jobStatus" class="form-label">Status</label>
                                        <select class="form-select" id="jobStatus" name="status" required>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php endif ?>  
</body>
</html>