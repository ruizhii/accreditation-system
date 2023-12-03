import {useNavigate, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import {useStateContext} from "../contexts/ContextProvider.jsx";
import axiosClient from "../axios-client.js";

export default function FacultyForm() {
  const {id} = useParams()
  const navigate = useNavigate()
  const [loading, setLoading] = useState(false)
  const [errors, setErrors] = useState(null)
  const{setNotification} = useStateContext()
  const [departments, setDepartments] = useState([
    {name: '', location: '', no_programmes: ''}
  ])
  // const [programmes, setProgrammes] = useState([
  //   {mqr_no: '', mqf_level: '', nec_code: '', location: '', type: '', enrolment: '', status: ''}
  // ])
  const [academic_staff, setAcademic_staff] = useState({
    malaysian_full_time_doctoral: '',
    malaysian_full_time_masters: '',
    malaysian_full_time_bachelors: '',
    malaysian_full_time_diploma: '',
    malaysian_full_time_certificate: '',
    malaysian_full_time_others: '',
    malaysian_part_time_doctoral: '',
    malaysian_part_time_masters: '',
    malaysian_part_time_bachelors: '',
    malaysian_part_time_diploma: '',
    malaysian_part_time_certificate: '',
    malaysian_part_time_others: '',
    non_malaysian_full_time_doctoral: '',
    non_malaysian_full_time_masters: '',
    non_malaysian_full_time_bachelors: '',
    non_malaysian_full_time_diploma: '',
    non_malaysian_full_time_certificate: '',
    non_malaysian_full_time_others: '',
    non_malaysian_part_time_doctoral: '',
    non_malaysian_part_time_masters: '',
    non_malaysian_part_time_bachelors: '',
    non_malaysian_part_time_diploma: '',
    non_malaysian_part_time_certificate: '',
    non_malaysian_part_time_others: '',
  })

  const [students, setStudents] = useState([
    {local_male:'' , local_female:'' , disabled_male:'' , disabled_female:'' , international_male:'' , international_female:'' , graduate_level:''}
  ])

  const [attritions, setAttritions] = useState([
    {
      year_1:'' , total_student_1:'' , no_student_dropout_1:'' , attrition_rate_1:'' , reason_1:'' ,
      year_2:'' , total_student_2:'' , no_student_dropout_2:'' , attrition_rate_2:'' , reason_2:'' ,
      year_3:'' , total_student_3:'' , no_student_dropout_3:'' , attrition_rate_3:'' , reason_3:'' , graduate_level:''
    }
  ])

  const [administrative_staff, setAdministrative_staff] = useState([
    {class:'' , no_staff:''}
  ])

  const [allocation, setAllocation] = useState({
    allocation_1:'',allocation_2:'', allocation_3:''
  })

  const [testFile, setTestFile] = useState("")

  const [programmeLeader, setProgrammeLeader] = useState({
    name: '',
    designation: '',
    tel: '',
    fax: '',
    email: ''
  })

  const [faculty, setFaculty] = useState({
    id:null,
    name: '',
    director_name: '',
    director_email: '',
    tel: '',
    fax: '',
    website: '',
    department: {},
    academic_staff: {},
    no_student: {},
    student_attrition: {},
    administrative_staff: {},
    annual_allocation: {},
    organizational_chart: undefined,
    programme_leader: {}
  })
  const handleDepartmendAdd = () => {
    setDepartments([...departments, {name: '', location: '', no_programmes: ''}])
  }

  const handleDepartmentRemove = (index) => {
    const list = [...departments];
    list.splice(index, 1);
    setDepartments(list);
  }

  const handleDepartmentChange = (e, index) => {
    const {name,value} = e.target
    const list = [...departments];
    list[index][name] = value;
    setDepartments(list);
    faculty.department = departments;
  };

  const handleAcademicStaffChange = (e) => {
    const {name,value} = e.target
    setAcademic_staff({
      ...academic_staff,
      [name]:parseInt(value)
    })
  };

  const handleStudentAdd = () => {
    setStudents([...students, {local_male:'' , local_female:'' , disabled_male:'' , disabled_female:'' , international_male:'' , international_female:'' , graduate_level:''}])
  }

  const handleStudentRemove = (index) => {
    const list = [...students];
    list.splice(index, 1);
    setStudents(list);
  }

  const handleStudentChange = (e, index) => {
    const {name,value} = e.target
    const list = [...students];
    if(name!="graduate_level"){
    list[index][name] = parseInt(value);
    } else {
        if(value == ""){
          list[index][name] = "Diploma";
        }
      list[index][name] = value;
    }
    setStudents(list);
    faculty.no_student = students;
  };

  const handleAttritionAdd = () => {
    setAttritions([...attritions, {
      year_1:'' , total_student_1:'' , no_student_dropout_1:'' , attrition_rate_1:'' , reason_1:'' ,
      year_2:'' , total_student_2:'' , no_student_dropout_2:'' , attrition_rate_2:'' , reason_2:'' ,
      year_3:'' , total_student_3:'' , no_student_dropout_3:'' , attrition_rate_3:'' , reason_3:'' , graduate_level: ''}])
  }

  const handleAttritionRemove = (index) => {
    const list = [...attritions];
    list.splice(index, 1);
    setAttritions(list);
  }

  const handleAttritionChange = (e, index) => {
    const {name,value} = e.target
    const list = [...attritions];
    list[index][name] = value;
    setAttritions(list);
    faculty.student_attrition = attritions;
  };

  const handleAdministrativeStaffAdd = () => {
    setAdministrative_staff([...administrative_staff, {
      class:'' , no_staff:''
    }])
  }

  const handleAdministrativeStaffRemove = (index) => {
    const list = [...administrative_staff];
    list.splice(index, 1);
    setAdministrative_staff(list);
  }

  const handleAdministrativeStaffChange = (e, index) => {
    const {name,value} = e.target
    const list = [...administrative_staff];
    list[index][name] = value;
    setAdministrative_staff(list);
    faculty.administrative_staff = administrative_staff;
  };

 const handleAllocationChange = (e) => {
  setAllocation({
    ...allocation,
    [e.target.name]:e.target.value
  })
  faculty.annual_allocation = allocation;
};

  const handleFileChange = (e) => {
    setTestFile(e.target.files[0])
    console.log(testFile)
    setFaculty({
      ...faculty,
      organizational_chart:testFile
    })
  }

  const handleProgrammeLeaderChange = (e) => {
    setProgrammeLeader({
      ...programmeLeader,
      [e.target.name]:e.target.value
    })
    faculty.programme_leader = programmeLeader;
  };

  if (id) {
    useEffect(() => {
      setLoading(true)
      axiosClient.get(`/faculties/${id}`)
        .then(({data}) => {
          setLoading(false)
          setFaculty(data)
          setDepartments(data.department)
          setAcademic_staff(data.academic_staff)
          setStudents(data.no_student)
          setAttritions(data.student_attrition)
          setAdministrative_staff(data.administrative_staff)
          setAllocation(data.annual_allocation)
          setProgrammeLeader(data.programme_leader)
        })
        .catch(() => {
          setLoading(false)
        })
    }, [])
  }

  

  const onSubmit = (ev) => {
    ev.preventDefault();
    faculty.academic_staff = academic_staff;

    if (faculty.id) {
      axiosClient.put(`/faculties/${faculty.id}`, faculty)
        .then(() => {
          setNotification("Faculty was successfully updated")
          navigate('/faculties')
        })
        .catch(err => {
          const response = err.response;
          if (response && response.status === 422) {
            setErrors(response.data.errors)
          }
        })
    } else {
      axiosClient.post(`/faculties`, faculty)
        .then(() => {
          setNotification("Faculty was successfully created")
          navigate('/faculties')
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
      {faculty.id && <h1>Update Faculty: {faculty.name}</h1>}
      {!faculty.id && <h1>New Faculty: </h1>}
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
            <input value={faculty.name} onChange={ev => setFaculty({...faculty,name: ev.target.value})} placeholder="Faculty name"/>
            <input value={faculty.director_name} onChange={ev => setFaculty({...faculty,director_name: ev.target.value})} placeholder="Director name"/>
            <input value={faculty.director_email} onChange={ev => setFaculty({...faculty,director_email: ev.target.value})} placeholder="Director email"/>
            <input value={faculty.tel} onChange={ev => setFaculty({...faculty,tel: ev.target.value})} placeholder="Telephone no"/>
            <input value={faculty.fax} onChange={ev => setFaculty({...faculty,fax: ev.target.value})} placeholder="Fax"/>
            <input value={faculty.website} onChange={ev => setFaculty({...faculty,website: ev.target.value})} placeholder="Website"/>
            List of Departments/Centres in the Academy/Faculty/Institute/Centre (and its branch campuses) and number of programmes offered:
            &nbsp;

            {departments.map((department, index) => (
              <div key = {index} className="form-row">
                <input name="name"  placeholder="department name" value={department.name} onChange={(e) => handleDepartmentChange(e, index)}/>
                <input name="location" placeholder="Location (On Campus /Off Campus)" value={department.location} onChange={(e) => handleDepartmentChange(e, index)}/>
                <input name="no_programmes" placeholder="Number of Programmes offered" value={department.no_programmes} onChange={(e) => handleDepartmentChange(e, index)}/>
                
                {departments.length > 1 && (
                  <button type="button" className="remove-btn"
                  onClick={() => handleDepartmentRemove(index)}
                  >
                    <span>-</span>
                  </button>
                )}
                  {departments.length - 1 === index &&
                (
                  <button type="button" className="add-btn"
                  onClick={handleDepartmendAdd}
                  >
                    <span>+</span>
                  </button>
                )}
                
              </div>
              ))
            }    
                  
                
              
            
            Total number of academic staff:
            &nbsp;
            <table class="table_form">
              <tr>
                <th rowSpan="2">Status</th>
                <th rowSpan="2">Academic Qualification</th>
                <th colSpan="3">Number of Academic Staff</th>
              </tr>
                <tr>
                  <th>Malaysian</th>
                  <th>Non-Malaysian</th>
                  <th>Total</th>
                </tr>
              <tr>
                <th class="difRow" rowSpan="7">Full-time</th>
                <th class="difRow">Doctoral (Level 8)</th>
                <td><input name="malaysian_full_time_doctoral" value={academic_staff.malaysian_full_time_doctoral} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_full_time_doctoral" value={academic_staff.non_malaysian_full_time_doctoral} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td>{academic_staff.malaysian_full_time_doctoral+academic_staff.non_malaysian_full_time_doctoral}</td>
              </tr>
              <tr>
              <th class="difRow">Masters (Level 7)</th>
                <td><input name="malaysian_full_time_masters" value={academic_staff.malaysian_full_time_masters} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_full_time_masters" value={academic_staff.non_malaysian_full_time_masters} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td>{academic_staff.malaysian_full_time_masters+academic_staff.non_malaysian_full_time_masters}</td>
              </tr>
              <tr>
              <th class="difRow">Bachelors (Level 6 - including professional qualification)</th>
                <td><input name="malaysian_full_time_bachelors" value={academic_staff.malaysian_full_time_bachelors} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_full_time_bachelors" value={academic_staff.non_malaysian_full_time_bachelors} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td>{academic_staff.malaysian_full_time_bachelors+academic_staff.non_malaysian_full_time_bachelors}</td>
              </tr>
              <tr>
              <th class="difRow">Diploma (Level 4)</th>
                <td><input name="malaysian_full_time_diploma" value={academic_staff.malaysian_full_time_diploma} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_full_time_diploma" value={academic_staff.non_malaysian_full_time_diploma} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td>{academic_staff.malaysian_full_time_diploma+academic_staff.non_malaysian_full_time_diploma}</td>
              </tr>
              <tr>
              <th class="difRow">Certificate (Level 3)</th>
                <td><input name="malaysian_full_time_certificate" value={academic_staff.malaysian_full_time_certificate} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_full_time_certificate" value={academic_staff.non_malaysian_full_time_certificate} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td>{academic_staff.malaysian_full_time_certificate+academic_staff.non_malaysian_full_time_certificate}</td>
              </tr>
              <tr>
              <th class="difRow">Others </th>
                <td><input name="malaysian_full_time_others" value={academic_staff.malaysian_full_time_others} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_full_time_others" value={academic_staff.non_malaysian_full_time_others} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td></td>
              </tr>
              <tr>
              <th class="difRow" >Sub-total </th>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th class="difRow" rowSpan="7">Part-time</th>
                <th class="difRow">Doctoral (Level 8)</th>
                <td><input name="malaysian_part_time_doctoral" value={academic_staff.malaysian_part_time_doctoral} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_part_time_doctoral" value={academic_staff.non_malaysian_part_time_doctoral} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td></td>
              </tr>
              <tr>
              <th class="difRow">Masters (Level 7)</th>
                <td><input name="malaysian_part_time_masters" value={academic_staff.malaysian_part_time_masters} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_part_time_masters" value={academic_staff.non_malaysian_part_time_masters} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td></td>
              </tr>
              <tr>
              <th class="difRow">Bachelors (Level 6 - including professional qualification)</th>
                <td><input name="malaysian_part_time_bachelors" value={academic_staff.malaysian_part_time_bachelors} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_part_time_bachelors" value={academic_staff.non_malaysian_part_time_bachelors} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td></td>
              </tr>
              <tr>
              <th class="difRow">Diploma (Level 4)</th>
                <td><input name="malaysian_part_time_diploma" value={academic_staff.malaysian_part_time_diploma} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_part_time_diploma" value={academic_staff.non_malaysian_part_time_diploma} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td></td>
              </tr>
              <tr>
              <th class="difRow">Certificate (Level 3)</th>
                <td><input name="malaysian_part_time_certificate" value={academic_staff.malaysian_part_time_certificate} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_part_time_certificate" value={academic_staff.non_malaysian_part_time_certificate} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td></td>
              </tr>
              <tr>
              <th class="difRow">Others </th>
              <td><input name="malaysian_part_time_others" value={academic_staff.malaysian_part_time_others} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td><input name="non_malaysian_part_time_others" value={academic_staff.non_malaysian_part_time_others} onChange={(e) => handleAcademicStaffChange(e)}/></td>
                <td></td>
              </tr>
              <tr>
              <th class="difRow" >Sub-total </th>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table>
            
            Total number of students:
            {/* Tabs for different graduate level */}
            &nbsp;
            {students.map((student, index) => (
              <div key = {index} className="form-row">
              <label for="graduate_level">Choose Graduate Level:</label>

              <select value={student.graduate_level} name="graduate_level" id="graduate_level" onChange={(e) => handleStudentChange(e, index)}>
              <option value="" hidden>Graduate Level</option>
                <option value="Diploma">Diploma</option>
                <option value="Undergraduate">Undergraduate</option>
                <option value="Postgraduate">Postgraduate</option>
              </select>
              &nbsp;
                <table class="table_form_student">
              <tr>
                <th rowSpan="2"></th>
                <th colSpan="2">Number of Students</th>
                <th rowSpan="2">Total</th>
                <th rowSpan="2">Disabled Student</th>
              </tr>
              <tr>
                <th>Local</th>
                <th>International</th>
              </tr>
              <tr>
                <th class="difRow">Male</th>
                <td><input name="local_male" value={student.local_male} onChange={(e) => handleStudentChange(e, index)}/></td>
                <td><input name="international_male" value={student.international_male} onChange={(e) => handleStudentChange(e, index)}/></td>
                <td></td>
                <td><input name="disabled_male" value={student.disabled_male} onChange={(e) => handleStudentChange(e, index)}/></td>
              </tr>
              <tr>
                <th class="difRow">Female</th>
                <td><input name="local_female" value={student.local_female} onChange={(e) => handleStudentChange(e, index)}/></td>
                <td><input name="international_female" value={student.international_female} onChange={(e) => handleStudentChange(e, index)}/></td>
                <td></td>
                <td><input name="disabled_female" value={student.disabled_female} onChange={(e) => handleStudentChange(e, index)}/></td>
              </tr>
              <tr>
                <th class="difRow">Total</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table>
                
                  {students.length - 1 === index &&
                (
                  <button type="button" className="add-btn"
                  onClick={handleStudentAdd}
                  >
                    <span>+</span>
                  </button>
                )}
                {students.length > 1 && (
                  <button type="button" className="remove-btn"
                  onClick={() => handleStudentRemove(index)}
                  >
                    <span>-</span>
                  </button>
                )}
                
              </div>
              ))
            }
            
            Student attrition:
            {/* Tabs for different graduate level */}
            &nbsp;
            {attritions.map((attrition, index) => (
              <div key = {index} className="form-row">
              <label for="graduate_level">Choose Graduate Level:</label>

              <select value={attrition.graduate_level} name="graduate_level" id="graduate_level" onChange={(e) => handleStudentChange(e, index)}>
              <option value="" hidden>Graduate Level</option>
                <option value="Diploma">Diploma</option>
                <option value="Undergraduate">Undergraduate</option>
                <option value="Postgraduate">Postgraduate</option>
              </select>
              &nbsp;
                <table class="table_form_student">
              <tr>
                <th>Period</th>
                <th>Year</th>
                <th>Total Students</th>
                <th>Number of Student Leaving the Institution without Graduating</th>
                <th>Attrition rate</th>
                <th>Main Reasons for Leaving</th>
              </tr>
              <tr>
                <th class="difRow">Past 1 year</th>
                <td><input type="number" name="year_1" value={attrition.year_1} onChange={(e) => handleAttritionChange(e, index)}/></td>
                <td><input type="number" name="total_student_1" value={attrition.total_student_1} onChange={(e) => handleAttritionChange(e, index)}/></td>
                <td><input type="number" name="no_student_dropout_1" value={attrition.no_student_dropout_1} onChange={(e) => handleAttritionChange(e, index)}/></td>
                <td></td>
                <td><input name="reason_1" value={attrition.reason_1} onChange={(e) => handleAttritionChange(e, index)}/></td>
              </tr>
              <tr>
                <th class="difRow">Past 2 years</th>
                <td><input type="number" name="year_2" value={attrition.year_2} onChange={(e) => handleAttritionChange(e, index)}/></td>
                <td><input type="number" name="total_student_2" value={attrition.total_student_2} onChange={(e) => handleAttritionChange(e, index)}/></td>
                <td><input type="number" name="no_student_dropout_2" value={attrition.no_student_dropout_2} onChange={(e) => handleAttritionChange(e, index)}/></td>
                <td></td>
                <td><input name="reason_2" value={attrition.reason_2} onChange={(e) => handleAttritionChange(e, index)}/></td>
              </tr>
              <tr>
                <th class="difRow">Past 3 years</th>
                <td><input type="number" name="year_3" value={attrition.year_3} onChange={(e) => handleAttritionChange(e, index)}/></td>
                <td><input type="number" name="total_student_3" value={attrition.total_student_3} onChange={(e) => handleAttritionChange(e, index)}/></td>
                <td><input type="number" name="no_student_dropout_3" value={attrition.no_student_dropout_3} onChange={(e) => handleAttritionChange(e, index)}/></td>
                <td></td>
                <td><input name="reason_3" value={attrition.reason_3} onChange={(e) => handleAttritionChange(e, index)}/></td>
              </tr>
            </table>
                
                  {attritions.length - 1 === index &&
                (
                  <button type="button" className="add-btn"
                  onClick={handleAttritionAdd}
                  >
                    <span>+</span>
                  </button>
                )}
                {attritions.length > 1 && (
                  <button type="button" className="remove-btn"
                  onClick={() => handleAttritionRemove(index)}
                  >
                    <span>-</span>
                  </button>
                )}
                
              </div>
              ))
            }
            



            Total number of administrative and support staff:
            &nbsp;
            <div>
                <table class="staff">
              <tr>
                <th class="test">No.</th>
                <th>Classification by Function (e.g.: technical, counselling, financial, IT, human resource, etc.) </th>
                <th>Number of Administrative and Support staff</th>
              </tr>
              {administrative_staff.map((staff,index) => (
                
              <tr key = {index}>
                <td>{index+1}</td>
                <td><input name="class" value={staff.class} onChange={(e) => handleAdministrativeStaffChange(e, index)}/></td>
                <td><input name="no_staff" value={staff.no_staff} onChange={(e) => handleAdministrativeStaffChange(e, index)}/></td>
              
              {administrative_staff.length > 1 && (
                <button type="button" className="remove-btn"
                onClick={() => handleAdministrativeStaffRemove(index)}
                >
                <span>-</span>
                </button>
              )}
              {administrative_staff.length - 1 === index && (
                <button type="button" className="add-btn"
                onClick={handleAdministrativeStaffAdd}
                >
                <span>+</span>
                </button>
              )}  
              </tr>
              
              ))}  
            </table>
            </div>
            
            
            Provide annual allocation for last three consecutive years:
            &nbsp;  
            <div>
              &nbsp;
                <table class="table_form_student">
              <tr>
                <th>Year</th>
                <th>Annual Allocation (Belanja Mengurus / OCAR / Tabung)</th>
              </tr>
              <tr>
                <th class="difRow">Past 1 year</th>
                <td><input type="number" name="allocation_1" value={allocation.allocation_1} onChange={ev => handleAllocationChange(ev)}/></td>
                </tr>
              <tr>
                <th class="difRow">Past 2 years</th>
                <td><input type="number" name="allocation_2" value={allocation.allocation_2} onChange={ev => handleAllocationChange(ev)}/></td>
                </tr>
              <tr>
                <th class="difRow">Past 3 years</th>
                <td><input type="number" name="allocation_3" value={allocation.allocation_3} onChange={ev => handleAllocationChange(ev)}/></td>
                </tr>
            </table>
            </div>
            Provide the latest organisational chart:
            faculty
            &nbsp;
            <div>
            <input type="file" onChange={e => handleFileChange(e)}/>
            </div>
            Details of Programme Leader (Timbalan Dekan/Timbalan Pengarah):
            &nbsp;
            <div>
            <input name="name" value={programmeLeader.name} onChange={ev => handleProgrammeLeaderChange(ev)} placeholder="Name and Title"/>
            <input name="designation" value={programmeLeader.designation} onChange={ev => handleProgrammeLeaderChange(ev)} placeholder="Designation"/>
            <input name="tel" value={programmeLeader.tel} onChange={ev => handleProgrammeLeaderChange(ev)} placeholder="Tel."/>
            <input name="fax" value={programmeLeader.fax} onChange={ev => handleProgrammeLeaderChange(ev)} placeholder="Fax"/>
            <input name="email" value={programmeLeader.email} onChange={ev => handleProgrammeLeaderChange(ev)} placeholder="Email"/>
            </div>

            <button onClick={onSubmit} className="btn">Save</button>
          </form>
        }
      </div>
    </>
  )
}