import { Navigate, createBrowserRouter } from 'react-router-dom'
import Login from './views/Login'
import Signup from './views/Signup'
import Users from './views/Users'
import NotFound from './views/NotFound'
import DefaultLayout from './components/DefaultLayout'
import GuestLayout from './components/GuestLayout'
import Dashboard from './views/Dashboard'
import UserForm from './views/UserForm'
import Faculties from './views/Faculties'
import FacultyForm from './views/FacultyForm'
import Departments from './views/Departments'
import DepartmentForm from './views/DepartmentForm'
import AcademicProgrammes from './views/AcademicProgrammes'
import AcademicProgrammeForm from './views/AcademicProgrammeForm'

const router = createBrowserRouter([
  {
    path: '/',
    element: <DefaultLayout />,
    children: [
      {
        path: '/',
        element: <Navigate to="/users" />,
      },
      {
        path: '/dashboard',
        element: <Dashboard />,
      },
      {
        path: '/users',
        element: <Users />,
      },
      {
        path: '/users/new',
        element: <UserForm key="userCreate"/>,
      },
      {
        path: '/users/:id',
        element: <UserForm key="userUpdate"/>,
      },
      {
        path: '/faculties',
        element: <Faculties />
      },
      {
        path: '/faculties/new',
        element: <FacultyForm key="facultyCreate"/>
      },
      {
        path: '/faculties/:id',
        element: <FacultyForm key="facultyUpdate"/>
      },
      {
        path: '/departments',
        element: <Departments />
      },
      {
        path: '/departments/new',
        element: <DepartmentForm key="departmentCreate"/>
      },
      {
        path: '/departments/:id',
        element: <DepartmentForm key="departmentUpdate"/>
      },
      {
        path: '/academicprogrammes',
        element: <AcademicProgrammes />
      },
      {
        path: '/academicprogrammes/new',
        element: <AcademicProgrammeForm key="academicProgrammeCreate"/>
      },
      {
        path: '/academicprogrammes/:id',
        element: <AcademicProgrammeForm key="academicProgrammeUpdate"/>
      },
    ]
  },
  {
    path: '/',
    element: <GuestLayout />,
    children: [
      {
        path: '/login',
        element: <Login />,
      },
      {
        path: '/signup',
        element: <Signup />,
      },
    ]
  },
  {
    path: '*',
    element: <NotFound />,
  },
])

export default router
