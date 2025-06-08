import ModalSaveCancel from 'core/modal_save_cancel';
import ModalEvents from 'core/modal_events';
import Templates from 'core/templates';
import {call as fetchMany} from 'core/ajax';
import {getString} from 'core/str';

export const init = async(ids) => {
    const rows = await getConfigNotes(ids);

    const context = {
        rows: rows,
    };

    window.console.log(rows);

    const table = await Templates.render('local_configkeeper/confignote_modal_table', context);

    const modal = await ModalSaveCancel.create({
        title: await getString('confignote', 'local_configkeeper'),
        body: table,
        removeOnClose: true,
        large: true,
    });

    await modal.show();

    modal.getRoot().on(ModalEvents.save, () => {
        // Get the values and ids from the form
        const inputs = document.getElementsByClassName('local-configkeeper-note');
        window.console.log('Inputs', inputs);

        // Call the external function to save the values

        // Close the modal
    });
};

const getConfigNotes = async(ids) => fetchMany([{
    methodname: 'local_configkeeper_get_confignotes',
    args: {
        ids: ids,
    },
}])[0];
