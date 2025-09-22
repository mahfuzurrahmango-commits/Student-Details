<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student Details</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        .preview-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        .invalid-feedback {
            display: block;
        }
    </style>
</head>

<body class="p-4">
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="mb-1">Student Details</h1>
            <div class="text-end">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                    + Add Student
                </button>
                <div id="custom-search" class="mt-2"></div>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-bordered" id="students-table" width="100%">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addForm" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Student ID -->
                    <div class="mb-2">
                        <label class="form-label">Student ID</label>
                        <input type="text" name="student_id" id="studentIdInput" class="form-control"
                               maxlength="13" placeholder="****-*-**-***">
                        <div class="invalid-feedback" id="error-student-id"></div>
                    </div>

                    <!-- Name -->
                    <div class="mb-2">
                        <label class="form-label">Name</label>
                        <input name="name" class="form-control">
                        <div class="invalid-feedback" id="error-name-add"></div>
                    </div>

                    <!-- Department -->
                    <div class="mb-2">
                        <label class="form-label">Department</label>
                        <select name="department" id="department" class="form-control">
                            <option value="">Select Department</option>
                            <option>Computer Science</option>
                            <option>Information Technology</option>
                            <option>Software Engineering</option>
                            <option>Data Science</option>
                            <option>Artificial Intelligence</option>
                            <option>Cybersecurity</option>
                            <option>Electrical Engineering</option>
                            <option>Mechanical Engineering</option>
                            <option>Civil Engineering</option>
                            <option>Chemical Engineering</option>
                            <option>Biotechnology</option>
                            <option>Biology</option>
                            <option>Chemistry</option>
                            <option>Physics</option>
                            <option>Mathematics</option>
                            <option>Economics</option>
                            <option>Business Administration</option>
                            <option>Accounting</option>
                            <option>Finance</option>
                            <option>Marketing</option>
                            <option>Management</option>
                            <option>Psychology</option>
                            <option>Sociology</option>
                            <option>Political Science</option>
                            <option>Law</option>
                            <option>Medicine</option>
                            <option>Nursing</option>
                            <option>Pharmacy</option>
                            <option>Education</option>
                            <option>Architecture</option>
                        </select>
                        <div class="invalid-feedback" id="error-department-add"></div>
                    </div>

                    <!-- Image -->
                    <div class="mb-2">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                        <div class="invalid-feedback" id="error-image-add"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">

                    <!-- Student ID -->
                    <div class="mb-2">
                        <label class="form-label">Student ID</label>
                        <input type="text" name="student_id" id="edit_student_id" class="form-control" maxlength="13">
                        <div class="invalid-feedback" id="error-student-id-edit"></div>
                    </div>

                    <!-- Name -->
                    <div class="mb-2">
                        <label class="form-label">Name</label>
                        <input name="name" id="edit_name" class="form-control">
                        <div class="invalid-feedback" id="error-name-edit"></div>
                    </div>

                    <!-- Department -->
                    <div class="mb-2">
                        <label class="form-label">Department</label>
                        <select name="department" id="edit_department" class="form-control">
                            <option value="">Select Department</option>
                            <!-- same list as above -->
                            <option>Computer Science</option>
                            <option>Information Technology</option>
                            <option>Software Engineering</option>
                            <option>Data Science</option>
                            <option>Artificial Intelligence</option>
                            <option>Cybersecurity</option>
                            <option>Electrical Engineering</option>
                            <option>Mechanical Engineering</option>
                            <option>Civil Engineering</option>
                            <option>Chemical Engineering</option>
                            <option>Biotechnology</option>
                            <option>Biology</option>
                            <option>Chemistry</option>
                            <option>Physics</option>
                            <option>Mathematics</option>
                            <option>Economics</option>
                            <option>Business Administration</option>
                            <option>Accounting</option>
                            <option>Finance</option>
                            <option>Marketing</option>
                            <option>Management</option>
                            <option>Psychology</option>
                            <option>Sociology</option>
                            <option>Political Science</option>
                            <option>Law</option>
                            <option>Medicine</option>
                            <option>Nursing</option>
                            <option>Pharmacy</option>
                            <option>Education</option>
                            <option>Architecture</option>
                        </select>
                        <div class="invalid-feedback" id="error-department-edit"></div>
                    </div>

                    <!-- Image -->
                    <div class="mb-2">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                        <div class="invalid-feedback" id="error-image-edit"></div>
                    </div>

                    <!-- Current Image Preview -->
                    <div class="mb-2" id="currentImageContainer"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function () {
            // ✅ Global CSRF setup
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            /** --------------------------
             * Helpers
             * -------------------------- */
            const clearErrors = (form) => {
                $(form + ' .invalid-feedback').text('');
                $(form + ' input, ' + form + ' select').removeClass('is-invalid');
            };

            const formatStudentId = (value) => {
                value = value.replace(/\D/g, "");
                let formatted = "";
                if (value.length > 0) formatted = value.substring(0, 4);
                if (value.length > 4) formatted += "-" + value.substring(4, 5);
                if (value.length > 5) formatted += "-" + value.substring(5, 7);
                if (value.length > 7) formatted += "-" + value.substring(7, 10);
                return formatted;
            };

            /** --------------------------
             * Format inputs
             * -------------------------- */
            $('#studentIdInput').on("input", function (e) {
                e.target.value = formatStudentId(e.target.value);
            });
            $('#edit_student_id').on("input", function (e) {
                e.target.value = formatStudentId(e.target.value);
            });

            /** --------------------------
             * DataTable Init
             * -------------------------- */
            let table = $('#students-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('students.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'student_id', name: 'student_id' },
                    { data: 'name', name: 'name' },
                    { data: 'department', name: 'department' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            /** --------------------------
             * Add Student
             * -------------------------- */
            $('#addForm').submit(function (e) {
                e.preventDefault();
                clearErrors('#addForm');
                const form = new FormData(this);

                $.ajax({
                    url: '/students',
                    method: 'POST',
                    data: form,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res.success) {
                            $('#addModal').modal('hide');
                            $('#addForm')[0].reset();
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors || {};
                            if (errors.student_id) {
                                $('#studentIdInput').addClass('is-invalid');
                                $('#error-student-id').text(errors.student_id[0]);
                            }
                            if (errors.name) {
                                $('input[name="name"]').addClass('is-invalid');
                                $('#error-name-add').text(errors.name[0]);
                            }
                            if (errors.department) {
                                $('#department').addClass('is-invalid');
                                $('#error-department-add').text(errors.department[0]);
                            }
                            if (errors.image) {
                                $('input[name="image"]').addClass('is-invalid');
                                $('#error-image-add').text(errors.image[0]);
                            }
                        }
                    }
                });
            });

            /** --------------------------
             * Edit Student
             * -------------------------- */
            $(document).on('click', '.editBtn', function () {
                clearErrors('#editForm');
                $('#currentImageContainer').html('');
                const id = $(this).data('id');

                $.get(`/students/${id}/edit`, function (student) {
                    $('#edit_id').val(student.id);
                    $('#edit_student_id').val(formatStudentId(student.student_id));
                    $('#edit_name').val(student.name);
                    $('#edit_department').val(student.department);

                    if (student.image) {
                        $('#currentImageContainer').html(`
                            <label class="form-label">Current Image</label>
                            <div><img src="/storage/${student.image}" class="preview-img rounded-circle"></div>
                        `);
                    }
                    $('#editModal').modal('show');
                });
            });

            $('#editForm').submit(function (e) {
                e.preventDefault();
                clearErrors('#editForm');
                const id = $('#edit_id').val();
                const form = new FormData(this);
                form.append('_method', 'PUT');

                $.ajax({
                    url: `/students/${id}`,
                    method: 'POST',
                    data: form,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res.success) {
                            $('#editModal').modal('hide');
                            $('#editForm')[0].reset();
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors || {};
                            if (errors.student_id) {
                                $('#edit_student_id').addClass('is-invalid');
                                $('#error-student-id-edit').text(errors.student_id[0]);
                            }
                            if (errors.name) {
                                $('#edit_name').addClass('is-invalid');
                                $('#error-name-edit').text(errors.name[0]);
                            }
                            if (errors.department) {
                                $('#edit_department').addClass('is-invalid');
                                $('#error-department-edit').text(errors.department[0]);
                            }
                            if (errors.image) {
                                $('input[name="image"]').addClass('is-invalid');
                                $('#error-image-edit').text(errors.image[0]);
                            }
                        }
                    }
                });
            });

            /** --------------------------
             * Delete Student
             * -------------------------- */
            $(document).on('click', '.deleteBtn', function () {
                if (!confirm('Are you sure you want to delete this student?')) return;
                const id = $(this).data('id');

                $.ajax({
                    url: `/students/${id}`,
                    method: 'DELETE',
                    success: function (res) {
                        if (res.success) table.ajax.reload(null, false);
                    },
                    error: function () {
                        alert('Something went wrong while deleting.');
                    }
                });
            });
        });
    </script>
</body>
</html>
