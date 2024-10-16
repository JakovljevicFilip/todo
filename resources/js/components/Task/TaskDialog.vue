<template>
    <q-dialog v-model="taskStore.taskDialog" persistent>
        <q-card style="min-width: 350px">
            <q-card-section>
                <div class="text-h6">Create New Task</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-input
                    dense
                    v-model="taskTitle"
                    label="Task Title"
                    autofocus
                    @keyup.enter="createTask"
                    :rules="[val => !!val || 'Title is required']"
                />

                <q-input
                    dense
                    v-model="taskDescription"
                    label="Description"
                    type="textarea"
                    autogrow
                />

                <q-toggle
                    v-model="toggleDate"
                    color="green"
                    label="Schedule task?"
                    class="q-mt-sm"
                    @click="handleToggleDate"
                />

                <q-input v-if="toggleDate" filled v-model="taskDate" mask="date">
                    <template v-slot:append>
                        <q-icon name="event" class="cursor-pointer">
                            <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                <q-date v-model="taskDate" :options="dateOptions">
                                    <div class="row items-center justify-end">
                                        <q-btn v-close-popup label="Close" color="primary" flat />
                                    </div>
                                </q-date>
                            </q-popup-proxy>
                        </q-icon>
                    </template>
                </q-input>
            </q-card-section>

            <q-card-actions align="right" class="text-primary">
                <q-btn flat label="Cancel" @click="closeDialog" />
                <q-btn flat label="Create Task" @click="createTask" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import {createTask as createTaskService} from '../../services/TaskService.js';
import { NewTask } from '../../types/NewTask';
import { useTaskStore } from '@/stores/TaskStore';
import { date } from 'quasar';

const taskStore = useTaskStore();

const toggleDate = ref(false);
const handleToggleDate = () => {
    if (toggleDate.value) {
        taskDate.value = today;
        return;
    }
    taskDate.value = null;
}

const today = date.formatDate(new Date(), 'YYYY-MM-DD');
const dateOptions = (date) => {
    return date >= today;
};

const taskTitle = ref('');
const taskDescription = ref('');
const taskDate = ref(today);

const closeDialog = () => {
    taskStore.closeTaskDialog();
};

const createTask = () => {
    if (!taskTitle.value) return;

    const newTask = {
        title: taskTitle.value,
        description: taskDescription.value,
        scheduled: taskDate.value,
    } as NewTask;

    createTaskService(newTask)
    .then(() => {
        taskStore.addTask(newTask);
        closeDialog();
    });
};
</script>

<style scoped>
</style>
