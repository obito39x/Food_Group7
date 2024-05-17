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
    $(document).on('click', '.delete-blog', function(e) {
        e.preventDefault();
        var blogId = $(this).data('blog-id');

        if (confirm('Are you sure you want to delete this blog?')) {
            $.ajax({
                url: '/blog/' + blogId,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        alert('Blog deleted successfully');
                        location.reload();
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function(xhr) {
                    alert('Request failed: ' + xhr.responseText);
                }
            });
        }
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

        $.ajax({
            url: '/blog/' + blogId,
            type: 'PUT',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                content: blogText
            },
            success: function (response) {
                if (response.success) {
                    blogContent.find('.blog_text').text(response.content).show();
                    blogContent.find('.edit-blog-form').hide();
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
window.onload = function() {
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
