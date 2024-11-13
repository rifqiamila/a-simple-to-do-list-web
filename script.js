document.addEventListener("DOMContentLoaded", () => {
    const editModal = document.getElementById("editModal");
    const closeModal = document.querySelector(".close");
    const editTaskInput = document.getElementById("edit_task_input");
    const taskIdInput = document.getElementById("task_id");

    document.querySelectorAll(".edit").forEach(button => {
        button.addEventListener("click", () => {
            taskIdInput.value = button.getAttribute("data-id");
            editTaskInput.value = button.getAttribute("data-task");
            editModal.style.display = "block";
        });
    });

    closeModal.addEventListener("click", () => {
        editModal.style.display = "none";
    });

    window.addEventListener("click", (event) => {
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
    });

    document.getElementById("taskForm").addEventListener("submit", (event) => {
        const input = document.getElementById("taskInput");
        input.classList.add("animate");
        setTimeout(() => input.classList.remove("animate"), 300);
    });

    document.querySelectorAll("tr").forEach(row => {
        row.addEventListener("mouseenter", () => {
            row.style.transform = "scale(1.02)";
            row.style.transition = "transform 0.2s ease";
        });
        row.addEventListener("mouseleave", () => {
            row.style.transform = "scale(1)";
        });
    });
    
    document.querySelector(".add_btn").addEventListener("click", () => {
        const button = document.querySelector(".add_btn");
        button.classList.add("shake");
        setTimeout(() => {
            button.classList.remove("shake");
        }, 500);
    }); 

});
