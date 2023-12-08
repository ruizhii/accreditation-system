import {useEffect, useState} from "react";
import {useStateContext} from "../contexts/ContextProvider.jsx";
import axiosClient from "../axios-client.js";
import {Link} from "react-router-dom";

export default function AcademicProgrammes() {
    const [academicProgrammes, setAcademicProgrammes] = useState([]);
    const [loading, setLoading] = useState(false);
    const {setNotification} = useStateContext()

    useEffect(() => {
      getAcademicProgrammes();
    }, [])

    const onDeleteClick = academicProgramme => {
        if (!window.confirm("Are you sure you want to delete this programme?")) {
          return
        }
        axiosClient.delete(`/academic_programmes/${academicProgramme.id}`)
      .then(() => {
        setNotification("Academic Programme was successfully deleted")
        getAcademicProgrammes()
      })
  }

  const getAcademicProgrammes = () => {
    setLoading(true)
    axiosClient.get('/academic_programmes')
      .then(({data}) => {
        setLoading(false)
        setAcademicProgrammes(data.data)
      })
      .catch(() => {
        setLoading(false)
      })
  }

  return (
    <div>
      <div style={{display: 'flex', justifyContent: 'space-between', allignItems: 'center'}}>
        <h1>Academic Programmes</h1>
        <Link to="/academicprogrammes/new" className="btn-add">Add new</Link>
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
          <tr>
            <th>ID</th>
            <th>Programme</th>
            <th>Create Date</th>
            <th>Actions</th>
          </tr>
          </thead>
          {loading &&
            <tbody>
            <tr>
              <td colSpan="5" className="text-center">
                Loading...
              </td>
            </tr>
            </tbody>
          }
          {!loading &&
            <tbody>
            {academicProgrammes.map(a => (
              <tr key={a.id}>
                <td>{a.id}</td>
                <td>{a.name}</td>
                <td>{a.created_at}</td>
                <td>
                  <Link className="btn-edit" to={'/academicprogrammes/' + a.id}>Edit</Link>
                  &nbsp;
                  <button className="btn-delete" onClick={ev => onDeleteClick(a)}>Delete</button>
                </td>
              </tr>
            ))}
            </tbody>
          }
        </table>
      </div>
    </div>
    )
}