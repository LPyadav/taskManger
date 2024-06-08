$(document).ready(function () {
    // Fetch tasks on page load
    var user_id = $("#user_id").val();
    fetchTasks(user_id);

    // Handle form submission
    $("#createForm").submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        var newTask = {
            title: $("#addTaskFormTitle").val(),
            description: $("#addTaskFormDescription").val(),
            status: $("#addTaskFormStatus").val(),
        };

        $.post("/api/tasks", formData)
            .done(function (response) {
                var task = response.data;
                var rowCount = $("#taskTableBody tr").length;
                var alreadyHave = $(
                    'tr[data-task-id="' + task.id + '"]'
                ).length;
                if (!alreadyHave) {
                    var row = $("<tr>").attr("data-task-id", task.id);
                    row.append($("<td>").text(rowCount + 1));
                    row.append($("<td>").text(task.title));
                    row.append($("<td>").text(task.description));
                    if (task.status == "pending") {
                        row.append(
                            $("<td>")
                                .text(task.status)
                                .addClass(
                                    "text-yellow-600 hover:text-yellow-900"
                                )
                        );
                    } else {
                        row.append(
                            $("<td>")
                                .text(task.status)
                                .addClass("text-green-600 hover:text-green-900")
                        );
                    }
                    var actions = $("<td>").addClass(
                        "px-6 py-4 whitespace-nowrap  text-sm font-medium"
                    );
                    var editButton = $("<button>")
                        .addClass(
                            "edit-btn text-indigo-600 hover:text-indigo-900"
                        )
                        .text("Edit")
                        .data("task", task)
                        .click(function () {
                            openEditModal($(this).data("task"));
                        });
                    actions.append(editButton);
                    var deleteButton = $("<button>")
                        .addClass(
                            "delete-btn text-red-600 hover:text-red-900 ml-2"
                        )
                        .text("Delete")
                        .data("task-id", task.id)
                        .click(function () {
                            deleteTask($(this).data("task-id"));
                        });
                    actions.append(deleteButton);
                    row.append(actions);
                    $("#taskTableBody").append(row);
                }
                // Hide the no records message if it's visible
                $("#noRecordsMessage").addClass("hidden");
                console.log("Task created:", response);
                $("#addModal").addClass("hidden");
            })
            .fail(function (error) {
                if (error.status === 422) {
                    var errors = error.responseJSON.errors;
                    // Display validation errors to the user
                    $.each(errors, function (key, value) {
                        // Assuming you have a function to display error messages
                        displayErrorMessage(key, value[0]);
                    });
                } else {
                    // Handle other errors (e.g., display generic error message)
                    console.error("Error:", error.responseText);
                }
            });
    });
});

function fetchTasks(id) {
    $.get("/api/tasks", {
        user_id: id,
    })
        .done(function (tasks) {
            var taskTableBody = $("#taskTableBody");
            if (tasks.data.length === 0) {
                $("#noRecordsMessage").removeClass("hidden");
            } else {
                var taskTableBody = $("#taskTableBody");
                // taskList.empty(); // Clear existing tasks
                tasks?.data.forEach(function (task, key) {
                    var row = $("<tr>").attr("data-task-id", task.id);
                    row.append($("<td>").text(key + 1));
                    row.append($("<td>").text(task.title));
                    row.append($("<td>").text(task.description));
                    if (task.status == "pending") {
                        row.append(
                            $("<td>")
                                .text(task.status)
                                .addClass(
                                    "text-yellow-600 hover:text-yellow-900"
                                )
                        );
                    } else {
                        row.append(
                            $("<td>")
                                .text(task.status)
                                .addClass("text-green-600 hover:text-green-900")
                        );
                    }
                    var actions = $("<td>").addClass(
                        "px-6 py-4 whitespace-nowrap  text-sm font-medium"
                    );
                    var editButton = $("<button>")
                        .addClass(
                            "edit-btn text-indigo-600 hover:text-indigo-900"
                        )
                        .text("Edit")
                        .data("task", task)
                        .click(function () {
                            openEditModal($(this).data("task"));
                        });
                    actions.append(editButton);
                    var deleteButton = $("<button>")
                        .addClass(
                            "delete-btn text-red-600 hover:text-red-900 ml-2"
                        )
                        .text("Delete")
                        .data("task-id", task.id)
                        .click(function () {
                            deleteTask($(this).data("task-id"));
                        });
                    actions.append(deleteButton);
                    row.append(actions);
                    taskTableBody.append(row);
                });
            }
        })
        .fail(function (error) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                // Display validation errors to the user
                $.each(errors, function (key, value) {
                    // Assuming you have a function to display error messages
                    displayErrorMessage(key, value[0]);
                });
            } else {
                // Handle other errors (e.g., display generic error message)
                console.error("Error:", xhr.responseText);
            }
        });
}

// Event listener for Save Changes button click
$("#saveChanges").click(function () {
    // Retrieve updated task data from modal fields
    var updatedTask = {
        id: $("#editTaskId").val(),
        title: $("#editTitle").val(),
        description: $("#editDescription").val(),
        status: $("#editStatus").val(),
    };

    // Handle saving changes (e.g., update task via AJAX)
    $.ajax({
        url: "/api/tasks/" + updatedTask.id,
        method: "PUT",
        data: updatedTask,
        success: function (response) {
            var row = $('tr[data-task-id="' + response.data.id + '"]');
            row.find("td:nth-child(2)").text(response.data.title);
            row.find("td:nth-child(3)").text(response.data.description);

            if (response.data.status == "pending") {
                row.find("td:nth-child(4)")
                    .text(response.data.status)
                    .removeClass()
                    .addClass("text-yellow-600 hover:text-yellow-900");
            } else {
                row.find("td:nth-child(4)")
                    .text(response.data.status)
                    .removeClass()
                    .addClass("text-green-600 hover:text-green-900");
            }
            $("#editModal").addClass("hidden");
        },
        error: function (xhr) {
            var errors = xhr.responseJSON.errors;
            if (errors?.title) {
                $("#editTitleError")
                    .text(errors.title[0])
                    .removeClass("hidden");
            }
            if (errors?.description) {
                $("#editDescriptionError")
                    .text(errors.description[0])
                    .removeClass("hidden");
            }
            if (errors?.status) {
                $("#editStatusError")
                    .text(errors.status[0])
                    .removeClass("hidden");
            }
        },
    });
});

function deleteTask(taskId) {
    if (window.confirm("Are you sure you want to delete this task?")) {
        $.ajax({
            url: "/api/tasks/" + taskId,
            method: "DELETE",
            success: function (response) {
                // Remove the row from the table
                $('tr[data-task-id="' + taskId + '"]').remove();
                if ($("#taskTableBody tr").length === 0) {
                    $("#noRecordsMessage").removeClass("hidden");
                }
            },
            error: function () {
                alert("Failed to delete task. Please try again later.");
            },
        });
    }
}

function displayErrorMessage(field, message) {
    // Display error message below the input field
    console.log(field, message);
    $("#" + field + "Error")
        .text(message)
        .removeClass("hidden");
}

// Clear validation errors
function clearValidationErrors() {
    $("#editTitleError").addClass("hidden");
    $("#editDescriptionError").addClass("hidden");
    $("#editStatusError").addClass("hidden");
}

// Hide error messages when user starts typing
$("#editTitle, #editDescription, #editStatus").on("input", function () {
    clearValidationErrors();
});

$("#addTaskButton").click(function () {
    $("#addModal").removeClass("hidden");
    clearValidationErrors();
});

// Event listener for Close button click
$("#closeAddModal, #closeEditModal").click(function () {
    // Close modal
    $("#addModal, #editModal").addClass("hidden");
    clearValidationErrors();
});

// Function to open modal and populate fields with task data
function openEditModal(task) {
    $("#editTaskId").val(task.id);
    $("#editTitle").val(task.title);
    $("#editDescription").val(task.description);
    $("#editStatus").val(task.status);
    $("#editModal").removeClass("hidden");
    clearValidationErrors();
}

Echo.channel(`task`).listen("TaskRealTimeUpdate", (data) => {
    if (data?.task?.type == "create") {
        var task = data?.task.data;
        var alreadyHave = $('tr[data-task-id="' + task.id + '"]').length;
        if (!alreadyHave) {
            var rowCount = $("#taskTableBody tr").length;
            var row = $("<tr>").attr("data-task-id", task.id);
            row.append($("<td>").text(rowCount + 1));
            row.append($("<td>").text(task.title));
            row.append($("<td>").text(task.description));
            if (task.status == "pending") {
                row.append(
                    $("<td>")
                        .text(task.status)
                        .addClass("text-yellow-600 hover:text-yellow-900")
                );
            } else {
                row.append(
                    $("<td>")
                        .text(task.status)
                        .addClass("text-green-600 hover:text-green-900")
                );
            }
            var actions = $("<td>").addClass(
                "px-6 py-4 whitespace-nowrap  text-sm font-medium"
            );
            var editButton = $("<button>")
                .addClass("edit-btn text-indigo-600 hover:text-indigo-900")
                .text("Edit")
                .data("task", task)
                .click(function () {
                    openEditModal($(this).data("task"));
                });
            actions.append(editButton);
            var deleteButton = $("<button>")
                .addClass("delete-btn text-red-600 hover:text-red-900 ml-2")
                .text("Delete")
                .data("task-id", task.id)
                .click(function () {
                    deleteTask($(this).data("task-id"));
                });
            actions.append(deleteButton);
            row.append(actions);
            $("#taskTableBody").append(row);
        }
    } else {
        if (data?.task?.type == "update") {
            var task = data?.task.data;
            var row = $('tr[data-task-id="' + task.id + '"]');
            row.find("td:nth-child(2)").text(task.title);
            row.find("td:nth-child(3)").text(task.description);

            if (task.status == "pending") {
                row.find("td:nth-child(4)")
                    .text(task.status)
                    .removeClass()
                    .addClass("text-yellow-600 hover:text-yellow-900");
            } else {
                row.find("td:nth-child(4)")
                    .text(task.status)
                    .removeClass()
                    .addClass("text-green-600 hover:text-green-900");
            }
        }
    }
});
$(document).ready(function () {
    // Open Assign Task modal and fetch users
    $("#assignTaskButton").click(function () {
        $.get("/api/users", function (users) {
            var userSelect = $("#user_ids");
            userSelect.empty();
            userSelect.append(
                '<option value="" disabled selected>Select User</option>'
            );
            users.forEach(function (user) {
                console.log(user);
                userSelect.append(new Option(user.name, user.id));
            });
        });

        $.get("/api/all-task", function (tasks) {
            var taskSelect = $("#task_id");
            taskSelect.empty();
            taskSelect.append(
                '<option value="" disabled selected>Select Task</option>'
            );

            tasks.forEach(function (task) {
                taskSelect.append(new Option(task.title, task.id));
            });
        });

        $("#assignModal").removeClass("hidden");
        clearValidationErrors();
    });

    // Close Assign Task modal
    $("#closeAssignModal").click(function () {
        $("#assignModal").addClass("hidden");
    });

    // Handle Assign Task form submission
    $("#assignTaskForm").submit(function (event) {
        event.preventDefault();

        var assignData = {
            assign_to: $("#user_ids").val(),
            user_id: $("#user_id").val(),
            task_id: $("#task_id").val(),
        };

        $.ajax({
            url: "/api/assign-task",
            method: "POST",
            data: assignData,
            success: function (response) {
                // Handle success
                console.log(response.message);
                $("#assignModal").addClass("hidden");
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                if (errors.user_id) {
                    $("#userError")
                        .text(errors.user_id[0])
                        .removeClass("hidden");
                }
                if (errors.task_id) {
                    $("#taskError")
                        .text(errors.task_id[0])
                        .removeClass("hidden");
                }
            },
        });
    });

    // Clear validation errors on input change
    $("#user_id, #task_id").change(function () {
        $("#userError, #taskError").addClass("hidden");
    });

    function clearValidationErrors() {
        $("#userError, #taskError").addClass("hidden");
    }
});


    $(document).ready(function() {
        // Show loader on AJAX start
        $(document).ajaxStart(function() {
            $("#overlay, #loader").show();
        });
        
        // Hide loader on AJAX complete
        $(document).ajaxStop(function() {
            $("#overlay, #loader").hide();
        });
    });

