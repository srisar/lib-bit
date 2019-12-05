import * as helper from "./helpers.js";
import * as form from './forms.js';
import {categoriesPageLogic} from './page/categories.js';

/**
 * Default code initialization
 */
$(function () {
    form.initDatepickerFiled();
    helper.initDatatables();
    helper.initFormValidation();

    categoriesPageLogic();


});


