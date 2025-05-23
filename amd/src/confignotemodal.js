import ModalSaveCancel from 'core/modal_save_cancel';
import {call as fetchMany} from 'core/ajax';

export const init = async(ids) => {
    const modal = await ModalSaveCancel.create({
        // Todo: get this via a string getter
        title: 'Config Note',
        removeOnClose: true,
        large: true,
    });

    // Get table data via ajax using ids.
    let data = await getConfigNotes(ids);
    window.console.log('data', data);
    await modal.show();
};

const getConfigNotes = async(ids) => fetchMany([{
    methodname: 'local_configkeeper_get_confignotes',
    args: {
        ids: ids,
    },
}])[0];