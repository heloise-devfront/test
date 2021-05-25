import logo from './logo.svg';
import './App.css';
import {useState, useEffect} from 'react'

const API = 'http://localhost:8083'

function App() {
    const [loaded, setLoaded] = useState(false) ;
    const [cars, setCars] = useState([]) ;
    useEffect(() => {
        if(!loaded) {
            fetch(`${API}/`, {
                credentials: 'same-origin',
            }).then(r => r.json()).then(datas => {
                console.log(datas)
                setCars(datas);
            })
            setLoaded(true);
        }
    }, [loaded]);

  return (
    <div className="App">
      <header className="">
          <h1>Toutes nos voitures</h1>
      </header>
        <table style={{width:'100%'}}>
            <thead>
            <tr>
                <th>Logo</th>
                <th>Nom</th>
                <th>Marque</th>
            </tr>
            </thead>
        <tbody>
        {
            cars.map(c => {
                return (<tr key={c.id}>
                    <td className={"logo"}></td>
                    <td className={"name"}>{c.name}</td>
                    <td className={"marque"}>{c.providerName}</td>
                </tr>)
            })
        }
        </tbody>
        </table>
    </div>
  );
}

export default App;
