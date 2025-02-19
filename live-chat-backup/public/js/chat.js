function fetchUsers() {
    fetch('/live-chat/public/fetch-users')
        .then(response => response.json())
        .then(users => {
            const userList = document.getElementById('user-list');
            userList.innerHTML = '<h3>Users Online</h3><ul>' + users.map(user => `
                <li>${user.name} - ${(Date.now() - new Date(user.last_active).getTime() < 300000) ? 'Online' : 'Offline'}</li>
            `).join('') + '</ul>';
        });
}

setInterval(() => {
    const receiverId = document.querySelector('select[name="receiver_id"]').value;
    fetchUsers();
}, 1000); // Update every 1 second

function fetchMessages() {
    fetch('/live-chat/public/fetch-messages')
        .then(response => response.json())
        .then(messages => {
            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML = messages.map(message => `
                <div>
                    <strong>${message.sender_name}:</strong> ${message.message} 
                    <em>${new Date(message.created_at).toLocaleString()}</em>
                </div>
            `).join('');
        });
}

setInterval(fetchMessages, 1000); // Fetch messages every second
