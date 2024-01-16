import {useNavigate, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import {useStateContext} from "../contexts/ContextProvider.jsx";
import axiosClient from "../axios-client.js";
import DatePicker from 'react-datepicker';
import moment from 'moment';
import 'react-datepicker/dist/react-datepicker.css'

export default function AccreditationForm() {
    const {id} = useParams()
    const navigate = useNavigate()
    const [loading, setLoading] = useState(false)
    const [errors, setErrors] = useState(null)
    const{setNotification} = useStateContext()
    const [programmes, setProgrammes] = useState([])
    const [submission_panel_due_date, setSubmission_panel_due_date] = useState(null)
    const [panel_meeting_date, setPanel_meeting_date] = useState(null)
    const [faculty_visit_date, setFaculty_visit_date] = useState(null)
    const [closing_meeting_date, setClosing_meeting_date] = useState(null)
    const [panel_report_qmec_date, setPanel_report_qmec_date] = useState(null)
    const [report_mqa_date, setReport_mqa_date] = useState(null)
    const [matter_expert_panel, setMatter_expert_panel] = useState([{
      name:'', email:''
    }])

    const [insider_panel, setInsider_panel] = useState([{
      name:'', email:''
    }])
    const [accreditation, setAccreditation] = useState({
        id:null,
        title: '',
        type: '',
        phase_num: '',
        matter_expert_panel: {},
        insider_panel: {},
        submission_panel_due_date: '',
        panel_meeting_date: '',
        faculty_visit_date: '',
        closing_meeting_date: '',
        panel_report_qmec_date: '',
        report_mqa_date: '',
        status: '',
        academic_programme_id: null,

    })

    const handleMatter_expert_panelAdd = () => {
      setMatter_expert_panel([...matter_expert_panel, {
        name:'', email:''
      }])
    }
  
    const handleMatter_expert_panelRemove = (index) => {
      const list = [...matter_expert_panel];
      list.splice(index, 1);
      setMatter_expert_panel(list);
    }
  
    const handleMatter_expert_panelChange = (e, index) => {
      const {name,value} = e.target
      const list = [...matter_expert_panel];
      list[index][name] = value;
      setMatter_expert_panel(list);
      accreditation.matter_expert_panel = matter_expert_panel;
    };

    const handleInsider_panelAdd = () => {
      setInsider_panel([...insider_panel, {
        name:'', email:''
      }])
    }
  
    const handleInsider_panelRemove = (index) => {
      const list = [...insider_panel];
      list.splice(index, 1);
      setInsider_panel(list);
    }
  
    const handleInsider_panelChange = (e, index) => {
      const {name,value} = e.target
      const list = [...insider_panel];
      list[index][name] = value;
      setInsider_panel(list);
      accreditation.insider_panel = insider_panel;
    };


    const [users,setUsers] = useState({
      name:null,
      role:null,
      permissions: {},
    })
    const can = (permission) => {
    const userPermissions = users?.permissions;
    if (Array.isArray(userPermissions)){
      return userPermissions.find((p) => p == permission) ? true : false;
    }}

    const roles = (role) => {
      const userRoles = users?.role;
      if (userRoles == role){
        return true;
      }else{
        return false;
      }
      }

    useEffect(() => {
        getUser();
        getProgrammes();
      }, [])

    if (id) {
        useEffect(() => {
          setLoading(true)
          axiosClient.get(`/accreditations/${id}`)
            .then(({data}) => {
              setLoading(false)
              setAccreditation(data)
              setSubmission_panel_due_date(new Date(data.submission_panel_due_date))
              setPanel_meeting_date(new Date(data.panel_meeting_date))
              setFaculty_visit_date(new Date(data.faculty_visit_date))
              setClosing_meeting_date(new Date(data.closing_meeting_date))
              setPanel_report_qmec_date(new Date(data.panel_report_qmec_date))
              setReport_mqa_date(new Date(data.report_mqa_date))
              setMatter_expert_panel(data.matter_expert_panel)
              setInsider_panel(data.insider_panel)
            })
            .catch(() => {
              setLoading(false)
            })
        }, [])
      }
      
      const getUser = () => {
        axiosClient.get('/profile')
        .then(({data}) => {
            setUsers(data.user)
        })
      }

      const getProgrammes = () => {
        axiosClient.get('/academic_programmes')
        .then(({data}) => {
            setProgrammes(data.data)
        })
    }
    
      const onSubmit = (ev) => {
        ev.preventDefault();
        if(roles('qmec')){
        accreditation.submission_panel_due_date = moment(submission_panel_due_date).format('YYYY-MM-DD');
        accreditation.panel_meeting_date = moment(panel_meeting_date).format('YYYY-MM-DD');
        accreditation.faculty_visit_date = moment(faculty_visit_date).format('YYYY-MM-DD');
        accreditation.closing_meeting_date = moment(closing_meeting_date).format('YYYY-MM-DD');
        accreditation.panel_report_qmec_date = moment(panel_report_qmec_date).format('YYYY-MM-DD');
        accreditation.report_mqa_date = moment(report_mqa_date).format('YYYY-MM-DD');
        }
        
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
          console.log(accreditation)
          axiosClient.post(`/accreditations`, accreditation)
            .then(() => {
              setNotification("Accreditation was successfully created")
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
                <input value={accreditation.title} onChange={ev => setAccreditation({...accreditation,title: ev.target.value})} placeholder="Title"/>
                {roles('programme_leader')?
                <div>
                <label>Choose a programme to be accredited:</label>
                <select value={accreditation.academic_programme_id} onChange={ev => setAccreditation({...accreditation,academic_programme_id: ev.target.value})}>
                  <option key="choose" value="">Select</option>
                    {programmes.map(({name,id}) => (
                        <option key={id} value={id}>{name}</option>
                    ))}
                </select>
                </div>
                : ""
                }
                <div>
                <label>Status:</label>
                <select value={accreditation.status} onChange={ev => setAccreditation({...accreditation,status: ev.target.value})}>
                  <option selected key="0" value="none">Choose status</option>
                  <option key="1" value="pending">Pending</option>
                  <option key="2" value="under review">Under Review</option>
                  <option key="3" value="reject">Reject</option>
                  <option key="4" value="approved">Approved</option>
                </select>
                </div>
                  <br></br>
                  {roles('programme_leader')?
                  <div>
                  <span>Provide 2 matter expert panels (Programme Leader nominate 2)</span>
                  </div>
                  : ""
                  }
                  {roles('qmec')?
                  <div>
                  <span>Choose 1 matter expert panels</span>
                  </div>
                  : ""
                  }
                <div>
              &nbsp;
              <table class="table_form_student">
              <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
              </tr>
              {matter_expert_panel.map((mep, index) => (
              <tr key = {index}>
                <th class="difRow">{index+1}</th>
                <td ><input name="name" value={mep.name} onChange={(e) => handleMatter_expert_panelChange(e, index)}/></td>
                <td><input name="email" value={mep.email} onChange={(e) => handleMatter_expert_panelChange(e, index)}/></td>
                {matter_expert_panel.length - 1 === index &&
                (
                  <button type="button" className="add-btn"
                  onClick={handleMatter_expert_panelAdd}
                  >
                    <span>+</span>
                  </button>
                )}
                {matter_expert_panel.length > 1 && (
                  <button type="button" className="remove-btn"
                  onClick={() => handleMatter_expert_panelRemove(index)}
                  >
                    <span>-</span>
                  </button>
                )}
              </tr>
              ))}
            </table>
            </div>
            <br></br>
            <div>
                Provide 2 inside panels (QMEC)
              &nbsp;
              <table class="table_form_student">
              <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
              </tr>
              {insider_panel.map((ip, index) => (
              <tr key = {index}>
                <th class="difRow">{index+1}</th>
                <td ><input name="name" value={ip.name} onChange={(e) => handleInsider_panelChange(e, index)}/></td>
                <td><input name="email" value={ip.email} onChange={(e) => handleInsider_panelChange(e, index)}/></td>
                {insider_panel.length - 1 === index &&
                (
                  <button type="button" className="add-btn"
                  onClick={handleInsider_panelAdd}
                  >
                    <span>+</span>
                  </button>
                )}
                {insider_panel.length > 1 && (
                  <button type="button" className="remove-btn"
                  onClick={() => handleInsider_panelRemove(index)}
                  >
                    <span>-</span>
                  </button>
                )}
              </tr>
              ))}
            </table>
            <br></br>
                </div>
                {roles('qmec')?
                <div><span>Submission panel due date: </span>
                  <DatePicker
                    selected={submission_panel_due_date}
                    onChange={date => setSubmission_panel_due_date(date)}
                    dateFormat="dd/MM/yyyy"
                    />
                    {console.log(submission_panel_due_date)}
                </div>
                : ""
                }
                {roles('qmec')?
                <div><span>Panel Meeting Date: </span>
                  <DatePicker
                    selected={panel_meeting_date}
                    onChange={date => setPanel_meeting_date(date)}
                    dateFormat="dd/MM/yyyy"
                    />
                </div>
                : ""
                }
                {roles('qmec')?
                <div><span>Faculty Visit Date: </span>
                  <DatePicker
                    selected={faculty_visit_date}
                    onChange={date => setFaculty_visit_date(date)}
                    dateFormat="dd/MM/yyyy"
                    />
                </div>
                : ""
                }
                {roles('qmec')?
                <div><span>Closing Meeting Date: </span>
                  <DatePicker
                    selected={closing_meeting_date}
                    onChange={date => setClosing_meeting_date(date)}
                    dateFormat="dd/MM/yyyy"
                    />
                </div>
                : ""
                }
                {roles('qmec')?
                <div><span>Panel Report QMEC Date: </span>
                  <DatePicker
                    selected={panel_report_qmec_date}
                    onChange={date => setPanel_report_qmec_date(date)}
                    dateFormat="dd/MM/yyyy"
                    />
                </div>
                : ""
                }
                {roles('qmec')?
                <div><span>Report MQA Date: </span>
                  <DatePicker
                    selected={report_mqa_date}
                    onChange={date => setReport_mqa_date(date)}
                    dateFormat="dd/MM/yyyy"
                    />
                </div>
                : ""
                } 
                <button onClick={onSubmit} className="btn">Save</button>
              </form>
            }
          </div>
        </>
      )
}
