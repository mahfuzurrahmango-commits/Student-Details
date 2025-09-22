{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student-List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ✅ DataTables CSS -->
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
        <!-- Header row -->
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="mb-0">Student Details</h2>
            <div class="text-end">
                <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addModal">Add Student</button>
                <!-- Search bar directly under Add Student -->
                <div id="custom-search"></div>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-bordered" id="students-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Name</th> <!-- ✅ merged column -->
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addForm" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Enter Student Id</label>
                        <input type="text" name="student_id" id="studentIdInput" class="form-control"
                            maxlength="13" placeholder="*************">
                        <div class="invalid-feedback" id="error-student-id"></div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const input = document.getElementById("studentIdInput");
                            input.addEventListener("input", function(e) {
                                let value = e.target.value.replace(/\D/g, "");
                                let formatted = "";
                                if (value.length > 0) formatted = value.substring(0, 4);
                                if (value.length > 4) formatted += "-" + value.substring(4, 5);
                                if (value.length > 5) formatted += "-" + value.substring(5, 7);
                                if (value.length > 7) formatted += "-" + value.substring(7, 10);
                                e.target.value = formatted;
                            });
                        });
                    </script>

                    <div class="mb-2">
                        <label class="form-label">Name</label>
                        <input name="name" class="form-control">
                        <div class="invalid-feedback" id="error-name-add"></div>
                    </div>

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

                    <div class="mb-2">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                        <div class="invalid-feedback" id="error-image-add"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="mb-2">
                        <label class="form-label">Enter Student Id</label>
                        <input type="text" name="student_id" id="edit_student_id" class="form-control" maxlength="13">
                        <div class="invalid-feedback" id="error-student-id-edit"></div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Name</label>
                        <input name="name" id="edit_name" class="form-control">
                        <div class="invalid-feedback" id="error-name-edit"></div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Department</label>
                        <select name="department" id="edit_department" class="form-control">
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
                        <div class="invalid-feedback" id="error-department-edit"></div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                        <div class="invalid-feedback" id="error-image-edit"></div>
                    </div>

                    <div class="mb-2" id="currentImageContainer"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ✅ DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function clearAddErrors() {
                $('#addForm .invalid-feedback').text('');
                $('#addForm input, #addForm select').removeClass('is-invalid');
            }

            function clearEditErrors() {
                $('#editForm .invalid-feedback').text('');
                $('#editForm input, #editForm select').removeClass('is-invalid');
            }

            let table = $('#students-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('students.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'student_id', name: 'student_id' },
                    { data: 'name', name: 'name' },   // ✅ merged image + name from backend
                    { data: 'department', name: 'department' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // ADD student
            $('#addForm').submit(function(e) {
                e.preventDefault();
                clearAddErrors();
                const form = new FormData(this);
                $.ajax({
                    url: '/students',
                    method: 'POST',
                    data: form,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.success) {
                            $('#addModal').modal('hide');
                            $('#addForm')[0].reset();
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function(xhr) {
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

            // Open Edit modal
            $(document).on('click', '.editBtn', function() {
                clearEditErrors();
                $('#currentImageContainer').html('');
                const id = $(this).data('id');
                $.get(`/students/${id}/edit`, function(student) {
                    $('#edit_id').val(student.id);
                    $('#edit_student_id').val(student.student_id);
                    $('#edit_name').val(student.name);
                    $('#edit_department').val(student.department);
                    if (student.image) {
                        $('#currentImageContainer').html(
                            `<label class="form-label">Current Image</label>
                             <div><img src="/storage/${student.image}" class="preview-img rounded-circle"></div>`
                        );
                    }
                    $('#editModal').modal('show');
                });
            });

            // Update student
            $('#editForm').submit(function(e) {
                e.preventDefault();
                clearEditErrors();
                const id = $('#edit_id').val();
                const form = new FormData(this);
                form.append('_method', 'PUT');
                $.ajax({
                    url: `/students/${id}`,
                    method: 'POST',
                    data: form,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.success) {
                            $('#editModal').modal('hide');
                            $('#editForm')[0].reset();
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function(xhr) {
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

            // Delete student
            $(document).on('click', '.deleteBtn', function() {
                if (!confirm('Delete this student?')) return;
                const id = $(this).data('id');
                $.ajax({
                    url: `/students/${id}`,
                    method: 'DELETE',
                    success: function(res) {
                        if (res.success) table.ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        alert('Something went wrong while deleting.');
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html> --}}


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student-Details</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ✅ DataTables CSS -->
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
        <!-- Header row -->
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="mb-0">Student Details</h2>
            <div class="text-end">
                <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addModal">Add Student</button>
                <!-- Search bar directly under Add Student -->
                <div id="custom-search"></div>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-bordered" id="students-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Name</th> <!-- ✅ merged column -->
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addForm" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Enter Student Id</label>
                        <input type="text" name="student_id" id="studentIdInput" class="form-control"
                            maxlength="13" placeholder= "**************">
                        <div class="invalid-feedback" id="error-student-id"></div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Name</label>
                        <input name="name" class="form-control">
                        <div class="invalid-feedback" id="error-name-add"></div>
                    </div>

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

                    <div class="mb-2">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                        <div class="invalid-feedback" id="error-image-add"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="mb-2">
                        <label class="form-label">Enter Student Id</label>
                        <input type="text" name="student_id" id="edit_student_id" class="form-control" maxlength="13">
                        <div class="invalid-feedback" id="error-student-id-edit"></div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Name</label>
                        <input name="name" id="edit_name" class="form-control">
                        <div class="invalid-feedback" id="error-name-edit"></div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Department</label>
                        <select name="department" id="edit_department" class="form-control">
                            <option value="">Select Department</option>
                            <!-- same department list -->
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

                    <div class="mb-2">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                        <div class="invalid-feedback" id="error-image-edit"></div>
                    </div>

                    <div class="mb-2" id="currentImageContainer"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ✅ DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function clearAddErrors() {
                $('#addForm .invalid-feedback').text('');
                $('#addForm input, #addForm select').removeClass('is-invalid');
            }

            function clearEditErrors() {
                $('#editForm .invalid-feedback').text('');
                $('#editForm input, #editForm select').removeClass('is-invalid');
            }

            // ✅ Format Student ID function
            function formatStudentId(value) {
                value = value.replace(/\D/g, ""); // remove non-digits
                let formatted = "";
                if (value.length > 0) formatted = value.substring(0, 4);
                if (value.length > 4) formatted += "-" + value.substring(4, 5);
                if (value.length > 5) formatted += "-" + value.substring(5, 7);
                if (value.length > 7) formatted += "-" + value.substring(7, 10);
                return formatted;
            }

            // Add input formatter
            $('#studentIdInput').on("input", function(e) {
                e.target.value = formatStudentId(e.target.value);
            });

            // Edit input formatter
            $('#edit_student_id').on("input", function(e) {
                e.target.value = formatStudentId(e.target.value);
            });

            let table = $('#students-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('students.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'student_id', name: 'student_id' },
                    { data: 'name', name: 'name' },   // ✅ merged image + name from backend
                    { data: 'department', name: 'department' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // ADD student
            $('#addForm').submit(function(e) {
                e.preventDefault();
                clearAddErrors();
                const form = new FormData(this);
                $.ajax({
                    url: '/students',
                    method: 'POST',
                    data: form,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.success) {
                            $('#addModal').modal('hide');
                            $('#addForm')[0].reset();
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function(xhr) {
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

            // Open Edit modal
            $(document).on('click', '.editBtn', function() {
                clearEditErrors();
                $('#currentImageContainer').html('');
                const id = $(this).data('id');
                $.get(`/students/${id}/edit`, function(student) {
                    $('#edit_id').val(student.id);
                    // ✅ Auto-format ID when loading from DB
                    $('#edit_student_id').val(formatStudentId(student.student_id));
                    $('#edit_name').val(student.name);
                    $('#edit_department').val(student.department);
                    if (student.image) {
                        $('#currentImageContainer').html(
                            `<label class="form-label">Current Image</label>
                             <div><img src="/storage/${student.image}" class="preview-img rounded-circle"></div>`
                        );
                    }
                    $('#editModal').modal('show');
                });
            });

            // Update student
            $('#editForm').submit(function(e) {
                e.preventDefault();
                clearEditErrors();
                const id = $('#edit_id').val();
                const form = new FormData(this);
                form.append('_method', 'PUT');
                $.ajax({
                    url: `/students/${id}`,
                    method: 'POST',
                    data: form,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.success) {
                            $('#editModal').modal('hide');
                            $('#editForm')[0].reset();
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function(xhr) {
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

            // Delete student
            $(document).on('click', '.deleteBtn', function() {
                if (!confirm('Delete this student?')) return;
                const id = $(this).data('id');
                $.ajax({
                    url: `/students/${id}`,
                    method: 'DELETE',
                    success: function(res) {
                        if (res.success) table.ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        alert('Something went wrong while deleting.');
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
