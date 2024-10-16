<template>
    <q-dialog v-model="taskStore.taskDialog" persistent @before-show="setupDialog">
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

                <q-input v-if="toggleDate" filled v-model="taskDate" mask="date" :rules="[val => !!val || 'Date is required']">
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
                <q-btn flat :label="editMode ? 'Save changes' : 'Create task'" @click="handleConfirmationClick" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import {createTask as createTaskService, changeTask as changeTaskService} from '../../services/TaskService.js';
import { NewTask } from '../../types/NewTask';
import { useTaskStore } from '@/stores/TaskStore';
import { date } from 'quasar';

const taskStore = useTaskStore();

const editMode = ref(false);

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

const taskId = ref('');
const taskTitle = ref('');
const taskDescription = ref('');
const taskDate = ref(today);

const closeDialog = () => {
    taskId.value = '';
    taskTitle.value = '';
    taskDescription.value = '';
    taskDate.value = '';
    editMode.value = false;
    taskStore.clearTask();
    taskStore.closeTaskDialog();
};

const handleConfirmationClick = () => {
    if (!taskTitle.value) return;
    if (taskId.value) {
        changeTask();
        return;
    }
    createTask();
};

const createTask = () => {
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

const changeTask = () => {
    const task = {
        id: taskId.value,
        title: taskTitle.value,
        description: taskDescription.value,
        scheduled: taskDate.value,
    } as Task;

    changeTaskService(task)
        .then(() => {
            taskStore.changeTask(task);
            closeDialog();
        });
};

const setupDialog = () => {
    const task = taskStore.task;
    if (task.id) {
        taskId.value = task.id;
        taskTitle.value = task.title;
        taskDescription.value = task.description;
        taskDate.value = task.scheduled;
        toggleDate.value = !!task.scheduled;
        editMode.value = true;
    }
}

</script>

<style scoped>
</style>
