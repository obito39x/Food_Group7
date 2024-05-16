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
                    var newCommentHtml = `
                        <div class="comment-list">
                            <div class="comment-avatar">
                                <img src="${response.user.img || '/img_profile/profile.png'}" alt="avatar" class="img">
                            </div>
                            <div class="comment-content">
                                <div class="comment-header">
                                    <p class="comment-user">${userName}</p>
                                    <div class="comment-options">
                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <p class="comment-time">${response.time_diff}</p>
                                <p class="comment-text">${response.comment}</p>
                            </div>
                        </div>
                    `;
                    $('.comment-section').prepend(newCommentHtml);
                    $('#comment-count-' + blogId).text(response.commentCount + ' comments');
                }
            },
            error: function (xhr, status, error) {
                alert('Error: ' + error.message);
            }
        });
    });

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

            if (confirm('Are you sure you want to delete this comment?')) {
                $.ajax({
                    url: '/comments/' + commentId,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert('Error: ' + response.error);
                        }
                    },
                    error: function (xhr) {
                        alert('Request failed: ' + xhr.responseText);
                    }
                });
            }
        });
    });
    $(document).ready(function () {
        // Hiển thị form chỉnh sửa bình luận khi nhấp vào nút "Edit"
        $('.edit-comment').click(function (e) {
            e.preventDefault();
            var commentId = $(this).data('comment-id');
            var commentContent = $(this).closest('.comment-content');
            commentContent.find('.comment-text').hide();
            commentContent.find('.edit-comment-form').show();
        });

        // Hủy chỉnh sửa bình luận
        $('.cancel-edit').click(function () {
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

            $.ajax({
                url: '/comments/' + commentId,
                type: 'PUT',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    comment: commentText
                },
                success: function (response) {
                    if (response.success) {
                        commentContent.find('.comment-text').text(response.comment).show();
                        commentContent.find('.edit-comment-form').hide();
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function (xhr) {
                    alert('Request failed: ' + xhr.responseText);
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

