$(document).ready(function () {
    $('#table').DataTable({
        "serverSide": true,
        "ajax": "exercises/get",
        "searching": false,
        "pageLength": 3,
        "lengthChange": false,
        "columns": [
            {"data": "user_name"},
            {"data": "email"},
            {"data": "text"},
            {
                "data": "is_finish",
                "render": function (data, type, row, meta) {
                    if (data !== '0') {
                        return '+';
                    } else {
                        return '-'
                    }
                }
            }
        ]
    });

    $('#adminTable').DataTable({
        "serverSide": true,
        "ajax": "exercises/get",
        "searching": false,
        "pageLength": 3,
        "lengthChange": false,
        "columns": [
            {"data": "user_name"},
            {"data": "email"},
            {"data": "text"},
            {
                "data": "is_finish",
                "render": function (data, type, row, meta) {
                    if (data !== '0') {
                        return '+';
                    } else {
                        return '-'
                    }
                }
            },
            {
                "data": "is_edit_by_admin",
                "render": function (data, type, row, meta) {
                    if (data !== '0') {
                        return '+';
                    } else {
                        return '-'
                    }
                }
            },
            {
                "data": "id",
                "orderable": false,
                "render": function (data, type, row, meta) {
                    edit = '<a href="/exercises/edit?id=' + data + '"><button type="button" class="btn btn-primary">Edit</button></a>';
                    return edit;
                }
            },
        ]
    });
});