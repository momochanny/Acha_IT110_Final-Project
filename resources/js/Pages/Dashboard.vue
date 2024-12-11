<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="steam-title">Dashboard</h2>
        </template>

        <div class="steam-ui-container">
            <div class="steam-notification" v-if="isVisible">
                <p>You're logged in!</p>
            </div>

            <div class="steam-todo-list">
                <TodoList />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import TodoList from '@/Components/TodoList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const isVisible = ref(true);

onMounted(() => {
    setTimeout(() => {
        isVisible.value = false;
    }, 6000);
});
</script>

<style scoped>
.steam-ui-container {
    max-width: 800px;
    margin: 2rem auto;
    background: #1b2838;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
    color: #c7d5e0;
}

.steam-title {
    font-size: 1.5rem;
    color: #66c0f4;
    text-align: center;
    margin-bottom: 1rem;
}

.steam-notification {
    text-align: center;
    background: #2a475e;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    color: #c7d5e0;
    font-size: 1.2rem;
}

.steam-todo-list {
    margin-top: 20px;
}
</style>
