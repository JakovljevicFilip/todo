<template>
    <div>
        <span :class="{ 'text-weight-bold': !displayCompleteTasks }">
            In progress
        </span>
        <q-toggle
            v-model="displayCompleteTasks"
            color="dark"
            @click="handleDisplayTasksToggle"
        />
        <span :class="{ 'text-weight-bold': displayCompleteTasks }">
            Completed
        </span>
    </div>

</template>

<script lang="ts" setup>
import { ref } from 'vue';
import { fetchCompletedTasks, fetchTasks } from '../../../services/TaskService.js';
import { useTaskStore } from '../../../stores/TaskStore.js';

const taskStore = useTaskStore();
const displayCompleteTasks = ref(false);

const handleDisplayTasksToggle = async () => {
    let tasks;
    if (displayCompleteTasks.value) {
        tasks = await fetchCompletedTasks();
    } else {
        tasks = await fetchTasks();
    }
    taskStore.setTasks(tasks);
};
</script>

<style scoped>

</style>
