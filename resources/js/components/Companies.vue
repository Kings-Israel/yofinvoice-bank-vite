<template>
  <div class="card" id="companies">
  <div class="p-3 d-flex justify-content-between">
    <div class="w-75 row">
      <div class="col-2">
        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Company Name" aria-describedby="defaultFormControlHelp" />
      </div>
      <div class="col-2">
        <select class="form-select" id="exampleFormControlSelect">
          <option value="">Company Type</option>
          <option value="1">Pending</option>
          <option value="2">Approved</option>
          <option value="3">Denied</option>
        </select>
      </div>
      <div class="col-2">
        <select class="form-select" id="exampleFormControlSelect">
          <option value="">Approval Status</option>
          <option value="1">Pending</option>
          <option value="2">Approved</option>
          <option value="3">Denied</option>
        </select>
      </div>
      <div class="col-2">
        <select class="form-select" id="exampleFormControlSelect">
          <option value="">Status</option>
          <option value="1">Pending</option>
          <option value="2">Approved</option>
          <option value="3">Denied</option>
        </select>
      </div>
      <div class="col-3">
        <select class="form-select" id="exampleFormControlSelect">
          <option value="">Bulk Actions</option>
          <option value="1">Approve</option>
          <option value="2">Reject</option>
        </select>
      </div>
    </div>
    <div class="d-flex justify-content-end w-25">
      <div class="">
        <select class="form-select" id="exampleFormControlSelect1">
          <option value="1">10</option>
          <option value="2">20</option>
          <option value="3">50</option>
        </select>
      </div>
      <div class="mx-2">
        <button type="button" class="btn btn-primary"><i class='ti ti-download ti-sm'></i></button>
      </div>
      <div class="mx-2">
        <a href="#" @click="createCompany()">
          <button type="button" class="btn btn-primary text-nowrap"><i class='ti ti-plus ti-sm'></i>Add Company</button>
        </a>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr class="">
          <th>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
            </div>
          </th>
          <th>Company Name</th>
          <th>Company Type</th>
          <th>Approval Status</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr class="text-nowrap" v-for="company in companies" :key="company.id">
          <td>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
            </div>
          </td>
          <td class="text-primary text-decoration-underline" style="cursor: pointer;" @click="viewCompany(company)">
            {{ company.name }}
          </td>
          <td class="">{{ company.organization_type }}</td>
          <td><span class="badge me-1 m_title" :class="resolveApprovalStatus(company.approval_status)">{{ company.approval_status }}</span></td>
          <td><span class="badge me-1 m_title" :class="resolveStatus(company.status)">{{ company.status }}</span></td>
          <td class="d-flex">
            <i class='ti ti-clock ti-sm text-primary'></i>
            <i class='ti ti-circle-check ti-sm text-success'></i>
            <i class='ti ti-arrows-cross ti-sm text-danger'></i>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <nav aria-label="Page navigation" class="mt-2 mx-2">
    <ul class="pagination justify-content-end">
      <li class="page-item prev">
        <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-left ti-xs"></i></a>
      </li>
      <li class="page-item active">
        <a class="page-link" href="javascript:void(0);">1</a>
      </li>
      <li class="page-item next">
        <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-right ti-xs"></i></a>
      </li>
    </ul>
  </nav>
</div>
</template>

<script>
import { computed, onMounted, ref } from 'vue'
import axios from 'axios'
export default {
  name: "Companies",
  props: ['bank'],
  setup(props) {
    const base_url = process.env.NODE_ENV == 'development' ? '/' : '/bank/'
    const companies = ref([])
    const bank = ref('')
    const getCompanies = async () => {
      await axios.get(base_url+props.bank+'/companies')
        .then(response => {
          companies.value = response.data.data.companies
        })
    }

    const resolveApprovalStatus = (status) => {
      let style = ''
      switch (status) {
        case 'pending':
          style = 'bg-label-primary'
          break;
        case 'approved':
          style = 'bg-label-success'
          break;
        case 'rejected':
          style = 'bg-label-danger'
          break;
        default:
          style = 'bg-label-primary'
          break;
      }
      return style
    }

    const resolveStatus = (status) => {
      let style = ''
      switch (status) {
        case 'active':
          style = 'bg-label-primary'
          break;
        case 'inactive':
          style = 'bg-label-secondary'
          break;
        default:
          style = 'bg-label-primary'
          break;
      }
      return style
    }

    const viewCompany = (company) => {
      window.location.href = base_url+props.bank+'/companies/'+company.id+'/details'
    }

    const createCompany = () => {
      window.location.href = base_url+props.bank+'/companies/create'
    }

    onMounted(() => {
      getCompanies()
    })

    return {
      companies,
      viewCompany,
      createCompany,
      resolveApprovalStatus,
      resolveStatus
    }
  }
}
</script>

<style>
.m_title::first-letter {
    text-transform: uppercase;
}
</style>
