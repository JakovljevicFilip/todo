<template>
    <q-dialog v-model="taskStore.taskDialog" persistent @before-show="setupDialog">
        <q-card style="min-width: 350px">
            <q-card-section>
                <div class="text-h6">Create New Task</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-form ref="taskForm">
                    <q-input
                        dense
                        v-model="taskTitle"
                        label="Task Title"
                        autofocus
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

                    <div v-if="toggleDate" class="q-pt-md text-center">
                        <q-date
                            v-model="taskDate"
                            minimal
                            :options="dateOptions"
                            :rules="[val => !!val || 'Date is missing.']"
                        />
                    </div>
                </q-form>
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

const today = date.formatDate(new Date(), 'YYYY/MM/DD');
const dateOptions = (date) => {
    return date >= today;
};

const toggleDate = ref(true);
const handleToggleDate = () => {
    if (toggleDate.value) {
        taskDate.value = today;
        return;
    }
    taskDate.value = null;
}

const taskForm = ref(null);

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

const handleConfirmationClick = async () => {
    const validation = await taskForm.value.validate();
    if (validation) {
        if (toggleDate.value && taskDate.value === null) {
            toggleDate.value = false;
        }
        if (taskId.value) {
            changeTask();
            return;
        }
        createTask();
    }
};

const createTask = () => {
    const newTask = {
        title: taskTitle.value,
        description: taskDescription.value,
        scheduled: taskDate.value,
    } as NewTask;

    createTaskService(newTask)
    .then((response) => {
        taskStore.addTask({
            ...newTask,
            id: response.id
        } as Task);
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
