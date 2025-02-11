var test;

document.addEventListener('DOMContentLoaded', function () {
    fetch('http://localhost:8000/api/posts',{
        method: 'GET',
        headers: {
            'Content-Type': 'application/json' 
        }
    })
        .then(response => response.json())  
        .then(posts => {
             test=posts;
             document.dispatchEvent(new CustomEvent("postsLoaded"));
            // const postsContainer = document.getElementById('postsContainer');
            // posts.forEach(post => {
            //     const postElement = document.createElement('div');
            //     postElement.classList.add('post');
            //     postElement.innerHTML = `
            //         <h2>${post.title}</h2>
            //         <p>${post.description}</p>
            //         <img src="http://127.0.0.1:8000/storage/${post.image}" alt="${post.title}" class="w-64 h-64 object-cover">
            //         <a href="${post.url}" target="_blank">URL</a>
            //     `;
            //     postsContainer.appendChild(postElement);
            // });
        })
        .catch(error => {
            console.error('Error fetching posts:', error);
        });
});