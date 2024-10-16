import axios from 'axios';
import { Task } from '../types/task';
import { NewTask } from '../types/NewTask';

export const fetchTasks = async (): Promise<Task[]> => {
    const response = await axios.get('/api/tasks');
    return response.data;
};

export const createTask = async (task: NewTask): Promise<string> => {
    const response = await axios.post('/api/tasks', task);
    return response.data;
};

export const fetchTask = async (id: string): Promise<Task> => {
    const response = await axios.get(`/api/tasks/${id}`);
    return response.data;
};

export const changeTask = async (task: Task): Promise<string> => {
    const response = await axios.post(`/api/tasks/${task.id}`, task);
    return response.data;
};

export const deleteTask = async (task: Task): Promise<string> => {
    const response = await axios.post(`/api/tasks/${task.id}/delete`, task);
    return response.data;
};
