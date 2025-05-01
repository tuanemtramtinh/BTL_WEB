const contactPageForm = document.querySelector("#contactForm");

if (contactPageForm) {
    // Chặn submit mặc định trước
    contactPageForm.addEventListener('submit', function(event) {
        event.preventDefault();
    });

    const validation = new JustValidate('#contactForm');

    validation
        .addField('#user-Name', [
            {
                rule: 'required',
                errorMessage: 'Vui lòng nhập tên',
            },
        ])
        .addField('#user-Email', [
            {
                rule: 'required',
                errorMessage: 'Vui lòng nhập email',
            },
            {
                rule: 'email',
                errorMessage: 'Email không hợp lệ',
            },
        ])
        .addField('#user-Message', [
            {
                rule: 'required',
                errorMessage: 'Vui lòng nhập tin nhắn',
            },
        ])
        .onSuccess((event) => {
            const form = event.target;
        
            const name = form.querySelector('[name="userName"]').value;
            const email = form.querySelector('[name="userEmail"]').value;
            const message = form.querySelector('[name="userMessage"]').value;
            const receive = form.querySelector('[name="agreeButton"]').checked;
            const status = "notSeen";
        
            const data = {
                name: name,
                email: email,
                message: message,
                receive: receive,
                status: status
            };
        
            fetch(`contact/addContact`, {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                if (data.code === "error") {
                    alert(data.message);
                    // reload lại trang để lấy $message từ session
                    window.location.reload(); 
                }
            
                if (data.code === "success") {
                    alert(data.message);
                    // cũng reload hoặc redirect nếu muốn
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Có lỗi xảy ra:', error);
            });
        });        
}