import React, { Fragment, useState, useRef, useEffect } from "react";
import { v4 as uuid } from 'uuid'
import { TodoList } from "./components/TodoList"

const KEY = "todoApp.todos";

export function App() {
    const [todos, setTodos] = useState([
        {id: 1, task: "Tarea 1", completed: false}
    ]);

    const todoTaskRef = useRef();

    useEffect(() => {
        const storedTodos = JSON.parse(localStorage.getItem(KEY));
        if (storedTodos) {
            setTodos(storedTodos);
        }
    }, [todos]);

    useEffect(() => {
        localStorage.setItem(KEY, JSON.stringify(todos))
    }, [todos]);

    const toggleTodo = (id) => {
        const newTodos = [...todos];
        const todo = newTodos.find((todo) => todo.id === id);
        todo.completed = !todo.completed;
        setTodos(newTodos);
    }

    const handleTodoAdd = () => {
        const task = todoTaskRef.current.value;
        if (task === "") return;

        setTodos((prevTodos) => {
            return [...prevTodos, {id: uuid(), task, completed: false}];
        });

        todoTaskRef.current.value = null;
    }

    const handleClearCompletedTodos = () => {
        const todosNotCompleted = todos.filter(todo => !todo.completed);
        setTodos(todosNotCompleted);
    }

    return (
        <Fragment>
            <TodoList todos={todos} toggleTodo={toggleTodo}/>
            <input ref={todoTaskRef} type="text" placeholder="Nueva Tarea"/>
            <button onClick={handleTodoAdd}>+</button>
            <button onClick={handleClearCompletedTodos}>-</button>
            <div>
                Te quedan {todos.filter(todo => !todo.completed).length} tareas por completar
            </div>
        </Fragment>
    );
}