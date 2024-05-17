function toggleLike(blogId) {
    fetch(`/blog/toggle-like/${blogId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const likeCount = document.querySelector(`#like-count-${blogId}`);
                const likeIcon = document.querySelector(`#like-icon-${blogId}`);
                const viewCount = document.querySelector(`#view-count-${blogId}`);
                likeCount.textContent = data.likes;
                likeIcon.className = data.liked ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
                viewCount.textContent = data.views + ' views';
            }
        })
        .catch(error => console.error('Error:', error));
}
$(document).ready(function () {
    $('#commentForm').submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();
        var url = $(this).attr('action');
        var blogId = $(this).data('blog-id');

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#comment').val('');
                    var userName = response.user.fullname || response.user.username;
                    var userImage = response.user.img || '/img_profile/profile.png';
                    var newCommentHtml = `
                        <div class="comment-list">
                            <div class="comment-container">
                                <div class="user">
                                    <div class="user-pic">
                                        <div class="comment-avatar">
                                            <img src="${userImage}" alt="avatar" class="img">
                                        </div>
                                    </div>
                                    <div class="user-info">
                                        <span class="comment-user">${userName}</span>
                                        <p class="comment-time">${response.time_diff}</p>
                                    </div>
                                    <div class="comment-options">
                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                        <ul class="comment-menu" style="display: none;">
                                            ${response.is_user_comment ? `
                                                <li><a href="#" class="edit-comment" data-comment-id="${response.comment_id}">Edit</a></li>
                                                <li><a href="#" class="delete-comment" data-comment-id="${response.comment_id}">Delete</a></li>
                                            ` : `
                                                <li><a href="#" class="report-comment" data-comment-id="${response.comment_id}">Report</a></li>
                                            `}
                                        </ul>
                                    </div>
                                </div>
                                    <p class="comment-text">
                                        ${response.comment}
                                    </p>
                                    <form class="edit-comment-form" data-comment-id="${response.comment_id}}" style="display: none;">
                                        <textarea class="form-control edit-comment-text"
                                            rows="3">${response.comment}}</textarea>
                                        <button type="submit" class="btn-save">Save</button>
                                        <button type="button" class="btn-cancel cancel-edit">Cancel</button>
                                    </form>
                            </div>
                        </div>
                    `;
                    $('.comment-section').prepend(newCommentHtml);
                    $('#comment-count-' + blogId).text(response.commentCount + ' comments');
                }
            },
            error: function (xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    });

    // Update the submit button state based on the input field value
    updateSubmitButtonState();

    $('#comment').on('input', function () {
        updateSubmitButtonState();
    });

    function updateSubmitButtonState() {
        var commentText = $('#comment').val().trim();
        $('#submitBtn').prop('disabled', commentText === "");
    }
});

$(document).ready(function () {
    $(document).on('click', '.comment-options i', function () {
        $(this).next('.comment-menu').toggle();
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('.comment-options').length) {
            $('.comment-menu').hide();
        }
    });
    $(document).on('click', '.report-comment', function (e) {
        e.preventDefault();
        var commentId = $(this).data('comment-id');
        // Code to handle comment report
        alert('Report comment: ' + commentId);
    });

    $(document).ready(function () {
        $('.delete-comment').click(function (e) {
            e.preventDefault();
            var commentId = $(this).data('comment-id');
            var blogId = $('#commentForm').data('blog-id');

            // Hiển thị SweetAlert xác nhận trước khi xóa
            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure you want to delete this comment?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu người dùng xác nhận xóa, thực hiện yêu cầu AJAX
                    $.ajax({
                        url: '/comments/' + commentId,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.success) {
                                // Hiển thị SweetAlert khi xóa thành công
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your comment has been deleted.",
                                    icon: "success"
                                }).then(() => {
                                    // Tải lại trang sau khi xóa thành công
                                    location.reload();
                                });
                            } else {
                                // Hiển thị SweetAlert khi có lỗi xóa
                                Swal.fire({
                                    title: "Error!",
                                    text: "Failed to delete comment. Please try again later.",
                                    icon: "error"
                                });
                            }
                        },
                        error: function (xhr) {
                            // Hiển thị SweetAlert khi có lỗi yêu cầu AJAX
                            Swal.fire({
                                title: "Error!",
                                text: "Request failed: " + xhr.responseText,
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });

    $(document).ready(function () {
        // Hiển thị form chỉnh sửa bình luận khi nhấp vào nút "Edit"
        $(document).on('click', '.edit-comment', function (e) {
            e.preventDefault();
            var commentId = $(this).data('comment-id');
            var commentContainer = $(this).closest('.comment-container');
            var commentContent = commentContainer.find('.comment-content');

            commentContent.find('.comment-text').hide();
            commentContent.find('.edit-comment-form').show();
        });

        // Hủy chỉnh sửa bình luận
        $(document).on('click', '.cancel-edit', function (e) {
            e.preventDefault();
            var commentContent = $(this).closest('.comment-content');

            commentContent.find('.edit-comment-form').hide();
            commentContent.find('.comment-text').show();
        });

        // Gửi yêu cầu cập nhật bình luận
        $('.edit-comment-form').submit(function (e) {
            e.preventDefault();
            var commentId = $(this).data('comment-id');
            var commentText = $(this).find('.edit-comment-text').val();
            var commentContent = $(this).closest('.comment-content');

            // Hiển thị SweetAlert xác nhận trước khi lưu thay đổi
            Swal.fire({
                title: "Do you want to save the changes?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Save",
                denyButtonText: `Don't save`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    // Nếu người dùng chấp nhận lưu, thực hiện yêu cầu AJAX
                    $.ajax({
                        url: '/comments/' + commentId,
                        type: 'PUT',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            comment: commentText
                        },
                        success: function (response) {
                            if (response.success) {
                                // Hiển thị SweetAlert khi lưu thành công
                                Swal.fire("Saved!", "", "success").then(() => {
                                    // Cập nhật nội dung bình luận trên giao diện
                                    commentContent.find('.comment-text').text(response.comment).show();
                                    commentContent.find('.edit-comment-form').hide();
                                });
                            } else {
                                // Hiển thị SweetAlert khi có lỗi trong quá trình lưu
                                Swal.fire("Error!", "Failed to save changes. Please try again later.", "error");
                            }
                        },
                        error: function (xhr) {
                            // Hiển thị SweetAlert khi có lỗi yêu cầu AJAX
                            Swal.fire("Error!", "Request failed: " + xhr.responseText, "error");
                        }
                    });
                } else if (result.isDenied) {
                    // Hiển thị SweetAlert khi người dùng không muốn lưu thay đổi
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });

    });
});

$(document).ready(function () {
    $(document).on('click', '.blog-options i', function () {
        $(this).next('.blog-menu').toggle();
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('.blog-options').length) {
            $('.blog-menu').hide();
        }
    });
    $(document).on('click', '.report-blog', function (e) {
        e.preventDefault();
        var blogId = $(this).data('blog-id');

        alert('Report blog: ' + blogId);
    });
    $(document).on('click', '.delete-blog', function (e) {
        e.preventDefault();
        var blogId = $(this).data('blog-id');

        // Hiển thị SweetAlert xác nhận trước khi xóa
        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to delete this blog?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Nếu người dùng xác nhận xóa, thực hiện yêu cầu AJAX
                $.ajax({
                    url: '/post/' + blogId,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            // Hiển thị SweetAlert khi xóa thành công
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your blog has been deleted.",
                                icon: "success"
                            }).then(() => {
                                // Tải lại trang sau khi xóa thành công
                                window.location.href = '/blog'; // Chuyển hướng về trang blog
                            });
                        } else {
                            // Hiển thị SweetAlert khi có lỗi xóa
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete blog. Please try again later.",
                                icon: "error"
                            });
                        }
                    },
                    error: function (xhr) {
                        // Hiển thị SweetAlert khi có lỗi yêu cầu AJAX
                        Swal.fire({
                            title: "Error!",
                            text: "Request failed: " + xhr.responseText,
                            icon: "error"
                        });
                    }
                });
            }
        });
    });



    $('.edit-blog').click(function (e) {
        e.preventDefault();
        var blogId = $(this).data('blog-id');
        var blogContent = $(this).closest('.blog_tag'); // Sửa thành tên class chứa form
        blogContent.find('.blog_text').hide();
        blogContent.find('.edit-blog-form').show();
    });

    $('.cancel-edit').click(function () {
        var blogContent = $(this).closest('.blog_tag'); // Sửa thành tên class chứa form
        blogContent.find('.edit-blog-form').hide();
        blogContent.find('.blog_text').show();
    });

    $('.edit-blog-form').submit(function (e) {
        e.preventDefault();
        var blogId = $(this).data('blog-id');
        var blogText = $(this).find('.edit-blog-text').val();
        var blogContent = $(this).closest('.blog_tag'); // Sửa thành tên class chứa form

        // Hiển thị SweetAlert xác nhận trước khi lưu thay đổi
        Swal.fire({
            title: "Do you want to save the changes?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't save`
        }).then((result) => {
            /* Xử lý dựa trên kết quả của SweetAlert */
            if (result.isConfirmed) {
                // Nếu người dùng chấp nhận lưu thay đổi, thực hiện yêu cầu AJAX
                $.ajax({
                    url: '/blog/' + blogId,
                    type: 'PUT',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        content: blogText
                    },
                    success: function (response) {
                        if (response.success) {
                            // Hiển thị SweetAlert thông báo khi lưu thành công
                            Swal.fire("Saved!", "", "success").then(() => {
                                // Cập nhật nội dung bài đăng và ẩn form chỉnh sửa
                                blogContent.find('.blog_text').text(response.content).show();
                                blogContent.find('.edit-blog-form').hide();
                            });
                        } else {
                            // Hiển thị SweetAlert khi có lỗi xảy ra
                            Swal.fire("Error!", response.error, "error");
                        }
                    },
                    error: function (xhr) {
                        // Hiển thị SweetAlert khi có lỗi yêu cầu AJAX
                        Swal.fire("Error!", "Request failed: " + xhr.responseText, "error");
                    }
                });
            } else if (result.isDenied) {
                // Nếu người dùng không muốn lưu thay đổi, hiển thị SweetAlert thông báo
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });
});
// post.js
$(document).on('click', '.follow-btn', function () {
    var userId = $(this).data('user-id');
    if (!userId) {
        console.error("User ID is null or undefined");
        return; // Ngừng thực hiện nếu userId là null
    }
    $.ajax({
        url: '/user/toggle-follow/' + userId,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                // Cập nhật nút "Follow" và trạng thái theo dõi
                if (response.following) {
                    $(this).text('Followed');
                } else {
                    $(this).text('Follow+');
                }
            }
        }.bind(this),
        error: function (xhr) {
            console.error(xhr.responseText);
        }
    });
});

