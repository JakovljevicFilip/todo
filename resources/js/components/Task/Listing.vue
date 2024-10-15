<template>
    <div>
        <h1 class="text-center">Task List</h1>
        <div class="q-pa-md row q-col-gutter-md">
            <div
                v-for="task in tasks"
                :key="task.id"
                class="col-12 col-sm-6 col-md-4 col-lg-3"
            >
                <TaskCard
                    :task="task"
                />
            </div>
        </div>
        <p v-if="error">{{ error }}</p>
        <p v-if="loading">Loading...</p>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { fetchTasks } from '@/services/task';
import TaskCard from './TaskCard.vue';
import { Task } from '../../types/task';

const tasks = ref<Task[]>([]);
const loading = ref<boolean>(true);
const error = ref<string | null>(null);

onMounted(async () => {
    try {
        tasks.value = await fetchTasks();
    } catch (err) {
        error.value = 'Failed to fetch tasks';
    } finally {
        loading.value = false;
    }
});
</script>

<style scoped>
/* Your styles here */
</style>
