import React from 'react';
import { PomodoroTimer } from './components/pomodoro-timer';
//import logo from './logo.svg';
import './App.css';

function App(): JSX.Element {
  return (
    <div className="container">
      <PomodoroTimer
        pomodoroTime={1500}
        shortRestTime={300}
        LongRestTime={900}
        cycles={4}
      />
    </div>
  );
}

export default App;
