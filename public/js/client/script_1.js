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
                    // alert(data.message);
                    // reload lại trang để lấy $message từ session
                    window.location.reload(); 
                }
            
                if (data.code === "success") {
                    // alert(data.message);
                    // cũng reload hoặc redirect nếu muốn
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Có lỗi xảy ra:', error);
            });
        });        
}

//section2
document.addEventListener("DOMContentLoaded", function () {
const section2Content = document.querySelector(".homePage__section2__content");

const observer = new IntersectionObserver(
    (entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
        section2Content.classList.add("visible");
        observer.unobserve(entry.target); // chỉ chạy 1 lần
        }
    });
    },
    {
    threshold: 0.3, // phần trăm section phải hiển thị trước khi kích hoạt
    }
);

observer.observe(section2Content);
});

//section3
document.addEventListener("DOMContentLoaded", function () {
    const section3Content = document.querySelector(".homePage__section3__content");
    const section3Image = document.querySelector(".homePage__section3__image");

    const observerOptions = { threshold: 0.3 };

    if (section3Content) {
      const observer3Content = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            section3Content.classList.add("visible");
            observer.unobserve(entry.target);
          }
        });
      }, observerOptions);

      observer3Content.observe(section3Content);
    }

    if (section3Image) {
      const observer3Image = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            section3Image.classList.add("visible");
            observer.unobserve(entry.target);
          }
        });
      }, observerOptions);

      observer3Image.observe(section3Image);
    }
});

//section4
document.addEventListener("DOMContentLoaded", function () {
    const section4Title = document.querySelector(".homePage__section4__title");
    const productElements = document.querySelectorAll(".homePage__section4__list--element");

    const options = { threshold: 0.3 };

    if (section4Title) {
      const observerTitle = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            section4Title.classList.add("visible");
            observer.unobserve(entry.target);
          }
        });
      }, options);
      observerTitle.observe(section4Title);
    }

    if (productElements.length > 0) {
      const observerProducts = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry, index) => {
          if (entry.isIntersecting) {
            // Thêm delay từng sản phẩm
            setTimeout(() => {
              entry.target.classList.add("visible");
            }, index * 150); // delay 150ms mỗi item
            observer.unobserve(entry.target);
          }
        });
      }, options);

      productElements.forEach(el => observerProducts.observe(el));
    }
});

// Đảm bảo rằng DOM đã sẵn sàng
document.addEventListener('DOMContentLoaded', function () {

    // Lấy các phần tử của section5 và section6
    const section5 = document.querySelector('.homePage__section5');
    const section6 = document.querySelector('.homePage__section6');
  
    // Tạo một hàm để thêm class khi phần tử vào viewport
    const addAnimationClass = (entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible'); // Thêm class 'visible' khi phần tử vào viewport
          observer.unobserve(entry.target); // Dừng theo dõi khi đã vào viewport
        }
      });
    };
  
    // Khởi tạo Intersection Observer
    const observer = new IntersectionObserver(addAnimationClass, {
      threshold: 0.5 // Phần tử sẽ được coi là vào viewport khi 50% của phần tử vào viewport
    });
  
    // Theo dõi section5 và section6
    observer.observe(section5);
    observer.observe(section6);
  
});  