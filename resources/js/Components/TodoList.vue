<template>
    <div class="todo-container">
        <h1 class="todo-title"><i class="fa fa-list"></i> To-Do List</h1>

        <!-- Form to add a new task -->
        <form @submit.prevent="addTask" class="todo-form">
            <div class="form-group">
                <input v-model="title" type="text" name="title" placeholder="Enter a task (max 50 characters)"
                    class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary add-btn">Add Task</button>
        </form>

        <!-- Display tasks -->
        <ul class="task-list">
            <li v-for="task in tasks" :key="task.id" class="task-item">
                <div class="task-content">
                    <!-- Checkbox to mark the task as completed -->
                    <input type="checkbox" v-model="task.completed" @change="updateTask(task, true)" />

                    <!-- Show task title or input field when editing -->
                    <span v-if="!task.isEditing" :class="{ completed: task.completed }">
                        {{ task.title }}
                    </span>
                    <input v-else v-model="task.title" type="text" class="edit-input" @blur="toggleEditMode(task)"
                        @keyup.enter="toggleEditMode(task)" />
                </div>

                <!-- Action buttons -->
                <div class="button-container">
                    <button class="update-btn" @click="toggleEditMode(task)">
                        <i class="fa" :class="task.isEditing ? 'fa-save' : 'fa-edit'"></i>
                    </button>
                    <button class="delete-btn" @click="deleteTask(task.id)">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            title: "",
            tasks: []
        };
    },
    mounted() {
        this.fetchTasks();
    },
    methods: {
        fetchTasks() {
            axios
                .get("http://localhost:8000/api/tasks")
                .then((response) => {
                    this.tasks = response.data || [];
                })
                .catch((error) =>
                    console.error("Error fetching tasks:", error)
                );
        },
        addTask() {
            const maxLength = 50;
            const validTitle = /^[a-zA-Z\s]+$/;

            if (this.title.trim() === "") {
                alert("Task title cannot be empty!");
                return;
            }

            if (this.title.length > maxLength) {
                alert(`Task title cannot exceed ${maxLength} characters`);
                return;
            }

            if (!validTitle.test(this.title)) {
                alert("Task title can only contain letters and spaces");
                return;
            }

            axios
                .post("http://localhost:8000/api/tasks", { title: this.title })
                .then((response) => {
                    this.tasks.push({
                        ...response.data,
                        isEditing: false,
                        completed: false
                    });
                    this.title = "";
                })
                .catch((error) =>
                    console.error("Error adding task:", error)
                );
        },
        updateTask(task, isCheckboxChange = false) {
            const updatedTask = {
                title: task.title,
                completed: task.completed
            };

            axios
                .put(`http://localhost:8000/api/tasks/${task.id}`, updatedTask)
                .then((response) => {
                    const index = this.tasks.findIndex((t) => t.id === task.id);
                    if (index !== -1) {
                        this.tasks[index] = {
                            ...response.data,
                            isEditing: false
                        };
                    }
                    if (!isCheckboxChange) {
                        alert("Task updated successfully!");
                    }
                })
                .catch((error) =>
                    console.error("Error updating task:", error)
                );
        },
        toggleEditMode(task) {
            if (task.isEditing) {
                if (task.title.trim() === "") {
                    alert("Task title cannot be empty!");
                    return;
                }
                this.updateTask(task);
            }
            task.isEditing = !task.isEditing;
        },
        deleteTask(id) {
            if (confirm("Are you sure you want to delete this task?")) {
                axios
                    .delete(`http://localhost:8000/api/tasks/${id}`)
                    .then(() => {
                        this.tasks = this.tasks.filter(
                            (task) => task.id !== id
                        );
                    })
                    .catch((error) =>
                        console.error("Error deleting task:", error)
                    );
            }
        }
    }
};
</script>

<style scoped>
/* Main container */
.todo-container {
    max-width: 600px;
    margin: 2rem auto;
    background: #1b2838;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
    color: #c7d5e0;

}

/* Title */
.todo-title {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 20px;
    color: #66c0f4;

}


.todo-form {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.form-control {
    flex: 1;
    padding: 10px;
    background: #2a475e;
    border: 1px solid #ffffff;
    color: #c7d5e0;
    border-radius: 4px;
}

.add-btn {
    background: #66c0f4;
    color: #1b2838;
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
}

/* Task list */
.task-list {
    list-style: none;
    padding: 0;
}

.task-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #2a475e;
    padding: 10px 20px;
    border-radius: 4px;
    margin-bottom: 10px;
    border: 1px solid #1b2838;
    color: #c7d5e0;
}

/* Task content */
.task-content {
    display: flex;
    align-items: center;
    gap: 10px;
}

input[type="checkbox"] {
    accent-color: #66c0f4;
}

.completed {
    text-decoration: line-through;
    color: #81909a;
}

/* Buttons */
.button-container button {
    background: transparent;
    border: none;
    color: #c7d5e0;
    cursor: pointer;
}

.button-container button:hover {
    color: #66c0f4;
    /* Hover effect */
}
</style>
