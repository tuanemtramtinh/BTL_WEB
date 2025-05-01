//adminnn
// Contact page

// Delete contact
const listButtonDelete = document.querySelectorAll("[button-delete]");
if (listButtonDelete.length > 0) {
  listButtonDelete.forEach(button => {
    button.addEventListener("click", () => {
      const dataApi = button.getAttribute("data-api");

      fetch(dataApi)
        // .then(res => res.text())
        .then(res => res.json())

        // .then(data => console.log(data))
        .then(data => {
          if (data.code == "error") {
            alert(data.message);
          }

          if (data.code == "success") {
            window.location.reload();
          }
        });
    });
  });
}
// End Delete contact

// Filter Status
const filterStatus = document.querySelector("[filter-status]");
if(filterStatus) {
  const url = new URL(window.location.href);

  // Lắng nghe thay đổi lựa chọn
  filterStatus.addEventListener("change", () => {
    const value = filterStatus.value;
    if(value) {
      url.searchParams.set("status", value);
    } else {
      url.searchParams.delete("status");
    }

    window.location.href = url.href;
  })

  // Hiển thị lựa chọn mặc định
  const valueCurrent = url.searchParams.get("status");
  if(valueCurrent) {
    filterStatus.value = valueCurrent;
  }
}
// End Filter Status

// Filter Start Date
const filterStartDate = document.querySelector("[filter-start-date]");
if (filterStartDate) {
  const url = new URL(window.location.href);
  filterStartDate.addEventListener("change", () => {
    const value = filterStartDate.value;
    if (value) {
      url.searchParams.set("startDate", value);
    } else {
      url.searchParams.delete("startDate");
    }
    window.location.href = url.href;
  });
  const valueCurrent = url.searchParams.get("startDate");
  if (valueCurrent) filterStartDate.value = valueCurrent;
}
// End Filter Start Date

// Filter End Date
const filterEndDate = document.querySelector("[filter-end-date]");
if (filterEndDate) {
  const url = new URL(window.location.href);
  filterEndDate.addEventListener("change", () => {
    const value = filterEndDate.value;
    if (value) {
      url.searchParams.set("endDate", value);
    } else {
      url.searchParams.delete("endDate");
    }
    window.location.href = url.href;
  });
  const valueCurrent = url.searchParams.get("endDate");
  if (valueCurrent) filterEndDate.value = valueCurrent;
}
// End Filter End Date

// Filter Reset
const filterReset = document.querySelector("[filter-reset]");
if (filterReset) {
  const url = new URL(window.location.href);

  filterReset.addEventListener("click", () => {
    // Reset tất cả query parameters
    url.search = "";

    // Đảm bảo đường dẫn luôn bắt đầu với '/BTL_WEB'
    if (!url.pathname.startsWith('/BTL_WEB')) {
      url.pathname = '/BTL_WEB' + url.pathname;  // Thêm '/BTL_WEB' vào đầu đường dẫn nếu chưa có
    }
    
    // Đảm bảo chúng ta luôn quay về '/admin/contact'
    url.pathname = '/BTL_WEB/admin/contact';

    window.location.href = url.href; // Chuyển hướng về URL đã cập nhật
  });
}
// End Filter Reset

// Check All
const checkAll = document.querySelector("[check-all]");
if(checkAll) {
  checkAll.addEventListener("click", () => {
    const listCheckItem = document.querySelectorAll("[check-item]");
    listCheckItem.forEach(item => {
      item.checked = checkAll.checked;
    })
  })
}
// End Check All

// Change Multi
const changeMulti = document.querySelector("[change-multi]");
if(changeMulti) {
  const dataApi = changeMulti.getAttribute("data-api");
  const select = changeMulti.querySelector("select");
  const button = changeMulti.querySelector("button");

  button.addEventListener("click", () => {
    const option = select.value;
    const listInputChecked = document.querySelectorAll("[check-item]:checked");
    if(option && listInputChecked.length > 0) {
      const ids = [];
      listInputChecked.forEach(inputChecked => {
        const id = inputChecked.getAttribute("check-item");
        ids.push(id);
      })

      const dataFinal = {
        option: option,
        ids: ids
      };

      fetch(dataApi, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(dataFinal)
      })
        .then(res => res.json())
        .then(data => {
          if(data.code == "error") {
            alert(data.message);
          }

          if(data.code == "success") {
            window.location.reload();
          }
        })
    } else {
      alert("Vui lòng chọn option và bản ghi muốn thực hiện!");
    }
  })
}
// End Change Multi

// Contact page