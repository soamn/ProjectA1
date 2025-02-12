var allPosts;

document.addEventListener('DOMContentLoaded', function () {
    fetch('http://localhost:8000/api/posts',{
        method: 'GET',
        headers: {
            'Content-Type': 'application/json' 
        }
    })
        .then(response => response.json())  
        .then(posts => {
             allPosts=posts;
             document.dispatchEvent(new CustomEvent("postsLoaded"));
           
        })
        .catch(error => {
            console.error('Error fetching posts:', error);
        });
});