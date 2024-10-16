<template>
    <div>
        <h1 class="text-center q-mb-sm">Task List</h1>
        <div class="q-pa-md row q-col-gutter-md">
            <div class="col-12 row justify-center q-mb-md">
                <Navigation/>
            </div>
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
<!--        TODO: Move messages into separate component.-->
        <p v-if="error">{{ error }}</p>
        <p v-if="loading">Loading...</p>
    </div>
</template>

<script setup lang="ts">
import { computed, ref, onMounted } from 'vue';
import { fetchTasks } from '@/services/TaskService';
import TaskCard from './TaskCard.vue';
import Navigation from './Navigation.vue';
import { useTaskStore } from '@/stores/TaskStore';

const taskStore = useTaskStore();

const tasks = computed(() => taskStore.tasks);
const loading = ref<boolean>(true);
const error = ref<string | null>(null);

onMounted(async () => {
    try {
        const tasks = await fetchTasks();
        taskStore.setTasks(tasks);
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
