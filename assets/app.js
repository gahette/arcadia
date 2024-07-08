import React from 'react';
import ReactDOM from 'react-dom/client';
import './styles/app.css';
import App from "./react/App";

const rootElement = document.getElementById('root');
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(
        <React.StrictMode>
            <App />
        </React.StrictMode>
    );
}