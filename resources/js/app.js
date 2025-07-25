import "./bootstrap";
import "./slider";
// import "./indexer";
// import './table'
// import './edit'

import Alpine from "alpinejs";
import departments from "./departments";
import faculties from "./faculties";

window.Alpine = Alpine;

Alpine.data("faculties", faculties);
Alpine.data("departments", departments);

Alpine.start();
