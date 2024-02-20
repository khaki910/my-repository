document.addEventListener('DOMContentLoaded', function() {
    fetchProfile();
});

document.addEventListener('DOMContentLoaded', function(){ 
    fetchPosts();
});
document.getElementById('create-post-form').addEventListener('submit', function(event){
    event.preventDefault();

    const formData = new FormData(this);
    fetch('server.php?action=create_post', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if(response.ok) {
            this.reset();
            fetchPosts();
        }
    });
});

function fetchProfile() {
    fetch('server.php?action=get_profile')
    .then(response => response.json())
    .then(data => {
        document.getElementById('bio').textContent = data.bio;
        document.getElementById('profile-link').addEventListener('click', function(event) {
            event.preventDefault();
            toggleProfile();
        });
    });
}

function toggleProfile() {
    const profileInfo = document.getElementById('profile-info');
    if(profileInfo.style.display === 'none') {
        profileInfo.style.display = 'block';
    } else {
        profileInfo.style.display = 'none';
    }
}
function fetchPosts() {
    const keyword = documentById('search-input').value;
    fetch(`server.php?action=search_posts&keyword=${keyword}`)
    .then(response => response.json())
    .then(data => {
        const postsContainer = document.getElementById('posts');
        postsContainer.innerHTML = '';
        data.forEach(post => {
            const postElement = document.createElement('article');
            postElement.innerHTML = `
            <h2>${post.title}</h2>
            <p>${post.content}</p>
            <p>Author: ${post.author}</p>
            <p>Created at: ${post.create_at}</p>
            <button onclick="deletePost({$post.id}">Delete</button>            
       `;
       postsContainer.appendChild(postElement);
        });
    });
}

function deletePost(postId) {
    fetch('server.php?action=delete_post&id=' + postId, {
        methid: 'DELETE'
    })
    .then(response => {
        if(response.ok) {
            fetchPosts();
        }
    });
} 
function searchPosts() {
    const keyword = document.getElementById('search-input').value;
    fetch(`server.php?action=search_posts&keyword=${keyword}`)
    .then(response => response.json())
    .then(data => {
        const postsContainer = document.getElementById('posts');
        postsContainer.innerHTML = ''; 
        data.forEach(post => {
            const postElement = document.createElement('article');
            postElement.innerHTML = `
                <h2>${post.title}</h2>
                <p>${post.content}</p>
                <p>Author: ${post.author}</p>
                <p>Created at: ${post.created_at}</p>
            `;
            postsContainer.appendChild(postElement);
        });
    });
} 
document.getElementById('post-form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const formData = new FormData(this);
    fetch('server.php?action=create_post', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            this.reset(); 
            fetchPosts(); 
        }
    });
});

