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
                // window.location.reload();
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
                                location.reload();
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
window.onload = function () {
    showFollowed();
};

function showFollowed() {
    document.getElementById("followed_list").style.display = "block";
    document.getElementById("follower_list").style.display = "none";
    moveIndicator(0);
}

function showFollower() {
    document.getElementById("followed_list").style.display = "none";
    document.getElementById("follower_list").style.display = "block";
    moveIndicator(1);
}

function moveIndicator(index) {
    const indicator = document.querySelector('.indicator');
    if (index === 0) {
        indicator.style.left = '2px';
    } else {
        indicator.style.left = 'calc(50% - 2px)';
    }
}
