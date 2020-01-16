import * as helper from "./helpers.js";
import * as form from './forms.js';
import {categoriesPageLogic} from './page/categories.js';
import {authorsPageLogic} from "./page/authors.js";
import {booksPageLogic} from "./page/books.js";

/**
 * Default code initialization
 */
$(function () {
    form.initDatepickerFiled();
    helper.initDatatables();
    helper.initFormValidation();

    categoriesPageLogic();
    authorsPageLogic();
    booksPageLogic();

});


