import {useNavigate, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import {useStateContext} from "../contexts/ContextProvider.jsx";
import axiosClient from "../axios-client.js";

export default function AccreditationForm() {
    const {id} = useParams()
    const navigate = useNavigate()
    const [loading, setLoading] = useState(false)
    const [errors, setErrors] = useState(null)
    const{setNotification} = useStateContext()
    const [programmes, setProgrammes] = useState([])
    const [accreditation, setAccreditation] = useState({
        id:null,
        title: '',
        type: '',
        phase_num: '',
        submission_panel_due_date: '',
        panel_meeting_date: '',
        faculty_visit_date: '',
        closing_meeting_date: '',
        panel_report_qmec_date: '',
        report_mqa_date: '',
        academic_programme_id: null,

    })

    useEffect(() => {
        getProgrammes();
      }, [])

    if (id) {
        useEffect(() => {
          setLoading(true)
          axiosClient.get(`/accreditations/${id}`)
            .then(({data}) => {
              setLoading(false)
              setAccreditation(data)
            })
            .catch(() => {
              setLoading(false)
            })
        }, [])
      }
    
      const getProgrammes = () => {
        axiosClient.get('/academic_programmes')
        .then(({data}) => {
            setProgrammes(data.data)
        })
    }
    
      const onSubmit = (ev) => {
        ev.preventDefault();
        if (accreditation.id) {
          axiosClient.put(`/accreditations/${accreditation.id}`, accreditation)
            .then(() => {
              setNotification("Accreditation was successfully updated")
              navigate('/accreditations')
            })
            .catch(err => {
              const response = err.response;
              if (response && response.status === 422) {
                setErrors(response.data.errors)
              }
            })
        } else {
          axiosClient.post(`/accreditations`, accreditation)
            .then(() => {
              setNotification("Academic programme was successfully created")
              navigate('/accreditations')
            })
            .catch(err => {
              const response = err.response;
              if (response && response.status === 422) {
                setErrors(response.data.errors)
              }
            })
        }
      }

    return (
        <>
          {accreditation.id && <h1>Update Accreditation: {accreditation.title}</h1>}
          {!accreditation.id && <h1>New Accreditation: </h1>}
          <div className="card animated fadeInDown">
            {loading && (
              <div className="text-center">Loading...</div>
            )}
            {errors && <div className="alert">
              {Object.keys(errors).map(key => (
                <p key={key}>{errors[key][0]}</p>
              ))}
            </div>
            }
            {!loading &&
              <form onSubmit={onSubmit}>
                <input value={accreditation.title} onChange={ev => setAccreditation({...accreditation,name: ev.target.value})} placeholder="Title"/>
                <div>
                <label>Choose a programme to be accredited:</label>
                <select value={accreditation.academic_programme_id} onChange={ev => setAccreditation({...accreditation,academic_programme_id: ev.target.value})}>
                  <option key="choose" value="">Select</option>
                    {programmes.map(({name,id}) => (
                        <option key={id} value={id}>{name}</option>
                    ))}
                </select>
                </div>
                
                <button onClick={onSubmit} className="btn">Save</button>
              </form>
            }
          </div>
        </>
      )
    

}